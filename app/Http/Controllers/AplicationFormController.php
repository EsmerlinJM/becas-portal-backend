<?php

namespace App\Http\Controllers;

use App\Models\AplicationForm;
use App\Models\Aplication;
use App\Models\FormularioDetail;
use Illuminate\Http\Request;

use App\Http\Resources\AplicationFormResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotBelongsTo;
use App\Exceptions\NotCandidate;
use App\Exceptions\ArrayEmpty;
use App\Tools\ResponseCodes;
use App\Tools\Tools;
use Carbon\Carbon;

class AplicationFormController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request)
    {
        $request->validate([
            'aplication_id' => 'required',
            'formulario_detail_id' => 'required',
            'answer'    => 'required',
        ]);

        $solicitud = Aplication::findOrFail($request->aplication_id);
        $pregunta = FormularioDetail::findOrFail($request->formulario_detail_id);

        $this->belongsToUser($solicitud);

        try {
            $respuesta = new AplicationForm();
            $respuesta->aplication_id = $solicitud->id;
            $respuesta->formulario_detail_id = $pregunta->id;
            $respuesta->answer = $request->answer;
            $respuesta->save();
            return new AplicationFormResource($respuesta);
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
    public function answerMultiple(Request $request)
    {
        $counter = 0;
        $answers_array = null;
        $answers =  json_decode($request->getContent());
        $solicitud = Aplication::findOrFail($answers->aplication_id);
        $this->belongsToUser($solicitud);

        if($answers) {
            foreach ($answers->respuestas as $item) {
                $pregunta = FormularioDetail::findOrFail($item->formulario_detail_id);
                try {
                    $respuesta = new AplicationForm();
                    $respuesta->aplication_id = $solicitud->id;
                    $respuesta->formulario_detail_id = $pregunta->id;
                    $respuesta->answer = $item->respuesta;
                    $respuesta->save();
                    $answers_array[$counter] = $respuesta;
                    $counter ++;
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            }
            return AplicationFormResource::collection($answers_array);
        } else {
            throw new ArrayEmpty;
        }










        if($respuestas) {
            foreach ($respuestas as $item) {
                $form = AplicationForm::findOrFail($item->aplication_form_id);
                $this->belongsToUser($solicitud);
                try {
                    $form->answer = $item->answer;
                    $form->updated_at = Carbon::now();
                    $form->save();
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            }
            $forms = AplicationForm::where('aplication_id',$form->aplication_id)->get();
            return AplicationFormResource::collection($forms);
        } else {
            throw new ArrayEmpty;
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
            'aplication_form_id' => 'required',
        ]);

        $form = AplicationForm::findOrFail($request->aplication_form_id);
        try {
            return new AplicationFormResource($form);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    public static function belongsToUser(Aplication $solicitud)
    {
        if (auth()->user()->candidate->id == $solicitud->candidate->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}