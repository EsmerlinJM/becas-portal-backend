<?php

namespace App\Http\Controllers;

use App\Models\FormacionAcademica;
use App\Models\Candidate;
use Illuminate\Http\Request;

use App\Http\Resources\FormacionAcademicaResourceFull;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotCandidate;
use App\Exceptions\NotBelongsTo;
use App\Exceptions\ArrayEmpty;
use App\Tools\Tools;
use Carbon\Carbon;

use App\Tools\GoogleBucketTrait;

class FormacionAcademicaController extends Controller
{

    use GoogleBucketTrait;
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->candidato) {
            try {
                $modelos = FormacionAcademica::where('candidate_id', $request->candidato)->get();
                return FormacionAcademicaResourceFull::collection($modelos);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }

        } else {
            try {
                $modelos = FormacionAcademica::all();
                return FormacionAcademicaResourceFull::collection($modelos);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
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
            'carrera' => 'required',
            'institucion' => 'required',
            'isBecado' => 'required',
            'indice' => 'required',
            'fecha_entrada' => 'required',
        ]);

        $candidato = auth()->user()->candidate;


        if($candidato) {
            $certificado = $this->upload($request, 'certificado');

            try {
                $formacion = new FormacionAcademica();
                $formacion->candidate_id = $candidato->id;
                $formacion->carrera = $request->carrera;
                $formacion->institucion = $request->institucion;
                $formacion->isBecado = $request->isBecado;
                $formacion->indice = $request->indice;
                $formacion->fecha_entrada = Carbon::parse($request->fecha_entrada);
                $formacion->fecha_salida = isset($request->fecha_salida) ? Carbon::parse($request->fecha_salida) : null;
                $formacion->certificacion_url = $certificado['url'];
                $formacion->certificacion_ext = $certificado['ext'];
                $formacion->certificacion_size = $certificado['size'];
                $formacion->save();

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
            return new FormacionAcademicaResourceFull($formacion);
        } else {
            throw new NotCandidate();
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
            'formacion' => 'required',
        ]);

        $formacion = FormacionAcademica::findOrFail($request->formacion);

        try {
            return new FormacionAcademicaResourceFull($formacion);
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
    public function update(Request $request)
    {
        $request->validate([
            'formacion' => 'required',
            'carrera' => 'required',
            'institucion' => 'required',
            'isBecado' => 'required',
            'indice' => 'required',
            'fecha_entrada' => 'required',
        ]);

        $candidato = auth()->user()->candidate;

        $formacion = FormacionAcademica::findOrFail($request->formacion);

        $this->belongsToUser($formacion);


        if($candidato) {

            $certificado = $this->upload($request, 'certificado');
            try {
                $formacion->carrera = $request->carrera;
                $formacion->institucion = $request->institucion;
                $formacion->isBecado = $request->isBecado;
                $formacion->indice = $request->indice;
                $formacion->fecha_entrada = Carbon::parse($request->fecha_entrada);
                $formacion->fecha_salida = isset($request->fecha_salida) ? Carbon::parse($request->fecha_salida) : null;
                if(isset($request->certificado)) {
                    $formacion->certificacion_url = $certificado['url'];
                    $formacion->certificacion_ext = $certificado['ext'];
                    $formacion->certificacion_size = $certificado['size'];
                }
                $formacion->save();

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
            return new FormacionAcademicaResourceFull($formacion);
        } else {
            throw new NotCandidate();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'formacion' => 'required',
        ]);
        $formacion = FormacionAcademica::findOrFail($request->formacion);

        $this->belongsToUser($formacion);

        try {
            $formacion->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    public static function belongsToUser(FormacionAcademica $formacion)
    {
        if ( auth()->user()->candidate->id == $formacion->candidato->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}