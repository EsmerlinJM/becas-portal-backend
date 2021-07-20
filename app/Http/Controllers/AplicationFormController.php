<?php

namespace App\Http\Controllers;

use App\Models\AplicationForm;
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
            'aplication_form_id' => 'required',
            'answer'    => 'required',
        ]);

        $form = AplicationForm::findOrFail($request->aplication_form_id);

        $this->belongsToUser($form);

        try {
            $form->answer = $request->answer;
            $form->updated_at = Carbon::now();
            $form->save();
            return new AplicationFormResource($form);
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
        $respuestas =  json_decode($request->getContent());

        if($respuestas) {
            foreach ($respuestas as $item) {
                $form = AplicationForm::findOrFail($item->aplication_form_id);
                $this->belongsToUser($form);
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

    public static function belongsToUser(AplicationForm $form)
    {
        if (auth()->user()->candidate->id == $form->aplication->candidate->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}
