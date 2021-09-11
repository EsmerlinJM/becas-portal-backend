<?php

namespace App\Http\Controllers;

use App\Models\AplicationDetail;
use App\Models\Aplication;
use App\Models\User;
use App\Models\Evaluator;
use Illuminate\Http\Request;

use App\Http\Resources\AplicationDetailResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotPermissions;

use App\Exceptions\AplicationClosed;
use App\Tools\ResponseCodes;
use App\Tools\Tools;
use Carbon\Carbon;

use App\Tools\NotificacionTrait;

class AplicationDetailController extends Controller
{

    use NotificacionTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function evaluate(Request $request)
    {
        $request->validate([
            'aplication_detail_id' => 'required',
            'score' => 'required|numeric',
        ]);

        $evaluator = Evaluator::where('user_id',auth()->user()->id)->first();
        $detail = AplicationDetail::findOrFail($request->aplication_detail_id);
        $aplication = $detail->aplication;

        $this->isOpen($aplication);
        $this->isEvaluador();

        try {
            if($request->score <= $detail->requirement->value) {
                $detail->evaluator_id = $evaluator->id;
                $detail->score = $request->score;
                $detail->notes = $request->notes;
                $detail->evaluated_at = Carbon::now();
                $detail->save();

                $aplication->score += $detail->score;
                if($aplication->score >= $aplication->convocatoria_detail->convocatoria->evaluation->pre_approved) {
                    $aplication->aplication_status_id = Tools::PRESELECCIONADO;
                } else {
                    $aplication->aplication_status_id = Tools::PROCESO_EVALUACION;
                }
                $aplication->save();

                $this->notificar($aplication->candidate->user, "Aplicacion en evaluacion", "Tu aplicación está ahora en proceso de evaluación.");

                return new AplicationDetailResource($detail);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Valor suministrado es superior al esperado'], ResponseCodes::UNPROCESSABLE_ENTITY);
            }

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }



    public static function isOpen(Aplication $solicitud)
    {
        if ( $solicitud->closed) {
            throw new AplicationClosed;
        }
    }

    public static function isEvaluador()
    {
        if (!Evaluator::where('user_id',auth()->user()->id)->first()) {
            throw new NotPermissions;
        }
    }
}