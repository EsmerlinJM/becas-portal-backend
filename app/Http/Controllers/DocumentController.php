<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use App\Models\Document;
use Illuminate\Http\Request;

use App\Http\Resources\DocumentResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotBelongsTo;
use App\Exceptions\NotCandidate;
use App\Tools\ResponseCodes;
use App\Tools\Tools;
use Carbon\Carbon;

class DocumentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Document::all();
        try {
            return DocumentResource::collection($documentos);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forUser()
    {
        $documentos = Document::where('candidate_id', auth()->user()->candidate->id)->get();
        try {
            return DocumentResource::collection($documentos);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function byAplication(Request $request)
    {
        $request->validate([
            'aplication_id' => 'required',
        ]);

        $documentos = Document::where('aplication_id',$request->aplication_id)->get();
        try {
            return DocumentResource::collection($documentos);
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
        $this->isCandidate();

        $request->validate([
            'document' => 'required',
            'name' => 'required',
        ]);

        if(isset($request->aplication_id)) {
            Aplication::findOrFail($request->aplication_id);
        }

        // Initialize Google Storage
        $disk = \Storage::disk('google');


        $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file('document')->getClientOriginalExtension());
        $disk->write($fileName, file_get_contents($request->file('document')), ['visibility' => 'public']);

        $url = $disk->url($fileName);
        $ext = $request->file('document')->getClientOriginalExtension();
        $size = $request->file('document')->getSize();

            try {
                $document = new Document;
                $document->candidate_id = auth()->user()->candidate->id;
                $document->aplication_id = isset($request->aplication_id) ? $request->aplication_id : null;
                $document->name = $request->name;
                $document->notes = isset($request->notes) ? $request->notes : null;
                $document->url = $url;
                $document->ext = $ext;
                $document->size = $size;
                $document->save();
                return new DocumentResource($document);
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
            'document_id' => 'required',
        ]);

        $document = Document::findOrFail($request->document_id);

        try {
            return new DocumentResource($document);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'document_id' => 'required',
        ]);

        $document = Document::findOrFail($request->document_id);

        $this->belongsToUser($document);

        try {
            $document->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
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

    public static function belongsToUser(Document $document)
    {
        if ( auth()->user()->candidate->id == $document->candidate->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}
