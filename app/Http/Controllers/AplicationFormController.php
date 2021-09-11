<?php

namespace App\Http\Controllers;

use App\Models\AplicationForm;
use App\Models\Aplication;
use App\Models\FormularioDetail;
use App\Models\Document;
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



        $respuesta = AplicationForm::findOrFail($request->aplication_form_id);

        $this->belongsToUser($respuesta);

        if($request->type == 'file') {
            $file = $this->upload($request, 'answer');
            $document = new Document();
            $document->candidate_id = auth()->user()->candidate->id;
            $document->aplication_id = $respuesta->aplication->id;
            $document->name = $file['name'];
            $document->url = $file['url'];
            $document->ext = $file['ext'];
            $document->size = $file['size'];
            $document->save();
        }

        try {
            $respuesta->answer = $request->type == 'file' ? $file['url'] : $request->answer;
            $respuesta->updated_at = Carbon::now();
            $respuesta->save();
            return new AplicationFormResource($respuesta);
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