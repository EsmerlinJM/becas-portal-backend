<?php

namespace App\Http\Controllers;

use App\Models\ExperienciaLaboral;
use App\Models\Candidate;
use Illuminate\Http\Request;

use App\Http\Resources\ExperienciaLaboralResourceFull;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotCandidate;
use App\Exceptions\NotBelongsTo;
use App\Tools\Tools;
use Carbon\Carbon;
use App\Tools\GoogleBucketTrait;

class ExperienciaLaboralController extends Controller
{
    use GoogleBucketTrait;
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->candidato) {
            try {
                $modelos = ExperienciaLaboral::where('candidate_id', $request->candidato)->get();
                return ExperienciaLaboralResourceFull::collection($modelos);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }

        } else {
            try {
                $modelos = ExperienciaLaboral::all();
                return ExperienciaLaboralResourceFull::collection($modelos);
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
            'empresa' => 'required',
            'posicion' => 'required',
            'telefono' => 'required',
            'tipo_contrato' => 'required',
            'fecha_entrada' => 'required',
        ]);

        // // Initialize Google Storage
        // $disk = \Storage::disk('google');

        $candidato = auth()->user()->candidate;


        if($candidato) {
            //Image Handling

            $image = $this->upload($request, 'documento');

            try {
                $experiencia = new ExperienciaLaboral();
                $experiencia->candidate_id = $candidato->id;
                $experiencia->empresa = $request->empresa;
                $experiencia->posicion = $request->posicion;
                $experiencia->telefono = $request->telefono;
                $experiencia->tipo_contrato = $request->tipo_contrato;
                $experiencia->fecha_entrada = Carbon::parse($request->fecha_entrada);
                $experiencia->rango_salarial = $request->rango_salarial;
                $experiencia->fecha_salida = isset($request->fecha_salida) ? Carbon::parse($request->fecha_salida) : null;
                $experiencia->documento_url = $image['url'];
                $experiencia->documento_ext = $image['ext'];
                $experiencia->documento_size = $image['size'];
                $experiencia->save();

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
            return new ExperienciaLaboralResourceFull($experiencia);
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
            'experiencia' => 'required',
        ]);

        $experiencia = ExperienciaLaboral::findOrFail($request->experiencia);

        try {
            return new ExperienciaLaboralResourceFull($experiencia);
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
            'experiencia' => 'required',
            'empresa' => 'required',
            'posicion' => 'required',
            'telefono' => 'required',
            'tipo_contrato' => 'required',
            'fecha_entrada' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        $experiencia = ExperienciaLaboral::findOrFail($request->experiencia);

        $this->belongsToUser($experiencia);


        //Image Handling
        $image = $this->upload($request, 'documento');

        try {
            $experiencia->empresa = $request->empresa;
            $experiencia->posicion = $request->posicion;
            $experiencia->telefono = $request->telefono;
            $experiencia->tipo_contrato = $request->tipo_contrato;
            $experiencia->fecha_entrada = Carbon::parse($request->fecha_entrada);
            $experiencia->rango_salarial = $request->rango_salarial;
            $experiencia->fecha_salida = isset($request->fecha_salida) ? Carbon::parse($request->fecha_salida) : null;
            if(isset($request->documento)) {
                $experiencia->documento_url = $image['url'];
                $experiencia->documento_ext = $image['ext'];
                $experiencia->documento_size = $image['size'];
            }
            $experiencia->save();

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

            return new ExperienciaLaboralResourceFull($experiencia);
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
            'experiencia' => 'required',
        ]);
        $experiencia = ExperienciaLaboral::findOrFail($request->experiencia);

        $this->belongsToUser($experiencia);

        try {
            $experiencia->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    public static function belongsToUser(ExperienciaLaboral $experiencia)
    {
        if ( auth()->user()->candidate->id == $experiencia->candidato->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}
