<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aplication;
use App\Models\AplicationDetail;
use App\Models\AplicationForm;
use App\Models\AplicationStatus;
use App\Models\Convocatoria;
use App\Models\ConvocatoriaDetail;
use App\Models\Candidate;
use Illuminate\Http\Request;

use App\Http\Resources\AplicationResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotBelongsTo;
use App\Exceptions\NotCandidate;
use App\Exceptions\AplicationClosed;
use App\Exceptions\AlreadyApplied;
use App\Exceptions\AlreadySent;
use App\Exceptions\ConvocatoriaClosed;
use App\Tools\ResponseCodes;
use App\Tools\Tools;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class AplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Aplication::all();
        try {
            return AplicationResource::collection($solicitudes);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function enviadas()
    {
        $solicitudes = Aplication::where('sent',true)->get();
        try {
            return AplicationResource::collection($solicitudes);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendientes()
    {
        $solicitudes = Aplication::where('sent',false)->get();
        try {
            return AplicationResource::collection($solicitudes);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviar(Request $request)
    {
        $request->validate([
            'aplication_id' => 'required',
        ]);

        $aplication = Aplication::findOrFail($request->aplication_id);

        if(!$aplication->sent) {
            try {
                $aplication->sent = true;
                $aplication->updated_at = Carbon::now();
                $aplication->save();
                return new AplicationResource($aplication);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            throw new AlreadySent;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cerradas()
    {
        $solicitudes = Aplication::where('closed', true)->get();
        try {
            return AplicationResource::collection($solicitudes);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'convocatoria_detail_id' => 'required',
        ]);

            $this->isCandidate();

            $convocatoria_detail = ConvocatoriaDetail::findOrFail($request->convocatoria_detail_id);
            $candidate = auth()->user()->candidate;
            $evaluation = $convocatoria_detail->convocatoria->evaluation;
            $formulario = $convocatoria_detail->convocatoria->formulario;

            $this->hasApplied($convocatoria_detail);

            $this->isConvocatoriaOpen($convocatoria_detail->convocatoria);

        try {
            $solicitud = new Aplication;
            $solicitud->convocatoria_id = $convocatoria_detail->convocatoria->id;
            $solicitud->convocatoria_detail_id = $convocatoria_detail->id;
            $solicitud->candidate_id = $candidate->id;
            $solicitud->aplication_status_id = Tools::SOLICITUD_INICIADA;
            $solicitud->score = 0;
            $solicitud->save();

            foreach ($evaluation->requirements as $item) {
                $detalle = new AplicationDetail;
                $detalle->aplication_id = $solicitud->id;
                $detalle->evaluation_requirement_id = $item->id;
                $detalle->save();
            }

            foreach ($formulario->details as $item) {
                $form = new AplicationForm;
                $form->aplication_id = $solicitud->id;
                $form->formulario_detail_id = $item->id;
                $form->save();
            }

            return new AplicationResource($solicitud);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'aplication_id' => 'required',
        ]);

        $solicitud = Aplication::findOrFail($request->aplication_id);

        try {
            return new AplicationResource($solicitud);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancelar(Request $request)
    {
        $request->validate([
            'aplication_id' => 'required',
            'razon' => 'required'
        ]);

        $solicitud = Aplication::findOrFail($request->aplication_id);

        $this->isOpen($solicitud);
        $this->belongsToUser($solicitud);

        try {
            $solicitud->aplication_status_id = Tools::SOLICITUD_CANCELADA_POR_CANDIDATO;
            $solicitud->closed = true;
            $solicitud->notes = $request->razon;
            $solicitud->save();
            return new AplicationResource($solicitud);

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cerrar(Request $request)
    {
        $request->validate([
            'aplication_id' => 'required',
            'aplication_status_id' => 'required', Rule::in([5,6,7,8]),
        ]);

        User::isCoordinator();

        if($request->aplication_status_id < 5) {
            return response()->json(['status' => 'error', 'message' => 'Estado no pertenece a los cierres'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }

        $status = AplicationStatus::findOrFail($request->aplication_status_id);
        $solicitud = Aplication::findOrFail($request->aplication_id);

        $this->isOpen($solicitud);

        try {
            $solicitud->aplication_status_id = $status->id;
            $solicitud->closed = true;
            $solicitud->notes = $request->notas;
            $solicitud->save();
            return new AplicationResource($solicitud);

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    public static function belongsToUser(Aplication $solicitud)
    {
        if ( auth()->user()->candidate->id == $solicitud->candidate->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }

    public static function isCandidate()
    {
        if ( auth()->user()->candidate ) {
            return true;
        } else {
            throw new NotCandidate;
        }
    }

    public static function isOpen(Aplication $solicitud)
    {
        if ( $solicitud->closed) {
            throw new AplicationClosed;
        }
    }

    public function isConvocatoriaOpen(Convocatoria $convocatoria)
    {
        if ( Carbon::now()->greaterThan(Carbon::parse($convocatoria->end_date)) ) {
            throw new ConvocatoriaClosed;
        }
    }

    public function hasApplied(ConvocatoriaDetail $detalle)
    {
        $aplicado = Aplication::where('candidate_id', auth()->user()->candidate->id)->where('convocatoria_detail_id', $detalle->id)->where('closed','0')->first();
        if ($aplicado) {
            throw new AlreadyApplied;
        }
    }
}
