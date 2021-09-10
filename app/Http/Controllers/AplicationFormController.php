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
use App\Tools\GoogleBucketTrait;
use Illuminate\Validation\Rule;

class AplicationFormController extends Controller
{

    use GoogleBucketTrait;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function answer(Request $request)
    {
        $request->validate([
            'aplication_form_id' => 'required',
            'answer' => 'required',
            'type'  => 'required', Rule::in(['file','text']),
        ]);

        if($request->type == 'file') {
            $file = $this->upload($request, 'answer');
        }

        $respuesta = AplicationForm::findOrFail($request->aplication_form_id);

        $this->belongsToUser($respuesta);

        try {
            $respuesta->answer = $request->type == 'file' ? $file['url'] : $request->answer;
            $respuesta->updated_at = Carbon::now();
            $respuesta->save();
            return new AplicationFormResource($respuesta);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function answerMultiple(Request $request)
    // {
    //     $counter = 0;
    //     $answers_array = null;
    //     $answers =  json_decode($request->getContent());

    //     if($answers) {
    //         foreach ($answers as $item) {
    //             $respuesta = AplicationForm::findOrFail($item->aplication_form_id);
    //             $this->belongsToUser($respuesta);
    //             try {
    //                 $respuesta->answer = $item->respuesta;
    //                 $respuesta->updated_at = Carbon::now();
    //                 $respuesta->save();
    //                 $answers_array[$counter] = $respuesta;
    //                 $counter ++;
    //             } catch (\Throwable $th) {
    //                 throw new SomethingWentWrong($th);
    //             }
    //         }
    //         return AplicationFormResource::collection($answers_array);
    //     } else {
    //         throw new ArrayEmpty;
    //     }
    // }

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

    public static function belongsToUser(AplicationForm $respuesta)
    {
        if (auth()->user()->candidate->id == $respuesta->aplication->candidate->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}