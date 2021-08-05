<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use App\Models\Parametro;
use App\Models\Candidate;
use App\Models\Scholarship;
use App\Models\ConvocatoriaType;
use App\Models\EducationLevel;
use App\Models\Audience;
use App\Models\InstitutionOffer;
use App\Models\DevelopmentArea;
use Illuminate\Http\Request;

use App\Http\Resources\ParametroResource;
use App\Http\Resources\ConvocatoriaTypeResource;
use App\Http\Resources\EducationLevelParameterResource;
use App\Http\Resources\AudienceResource;
use App\Http\Resources\InstitutionOfferResource;
use App\Http\Resources\DevelopmentAreaResource;
use App\Exceptions\SomethingWentWrong;
use App\Tools\Tools;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $tipos_convocatorias = ConvocatoriaType::all();
            $niveles_educativos = EducationLevel::select('name')->groupBy('name')->get();
            $audiencias = Audience::all();
            $area_desarrollo = DevelopmentArea::all();

            $candidatos_mujeres = Candidate::where('genero','femenino')->count();
            $candidatos_hombres = Candidate::where('genero','masculino')->count();
            $candidatos = Candidate::all()->count();

            $becados = Scholarship::all()->count();
            $becados_egresados = Scholarship::where('estado','egresado')->count();
            $becados_retirados = Scholarship::where('estado','retirado')->count();
            $becados_expulsados = Scholarship::where('estado','expulsado')->count();
            $becados_activos = Scholarship::where('estado','activo')->count();
            $becados_suspendido = Scholarship::where('estado','suspendido')->count();
            $becados_hombres = Scholarship::where('genero','masculino')->count();
            $becados_mujeres = Scholarship::where('genero','femenino')->count();

            $solicitudes_no_terminadas = Aplication::where('sent', false)->count();
            $solicitudes_enviadas = Aplication::where('sent', true)->count();


            $parametros['tipos_convocatorias'] = ConvocatoriaTypeResource::collection($tipos_convocatorias);
            $parametros['niveles_educativos'] = EducationLevelParameterResource::collection($niveles_educativos);
            $parametros['audiencias'] = AudienceResource::collection($audiencias);
            $parametros['area_desarrollo'] = DevelopmentAreaResource::collection($area_desarrollo);
            $parametros['candidatos']['mujeres'] = $candidatos_mujeres;
            $parametros['candidatos']['hombres'] = $candidatos_hombres;
            $parametros['candidatos']['total'] = $candidatos;

            $parametros['becados']['egresados'] = $becados_egresados;
            $parametros['becados']['retirados'] = $becados_retirados;
            $parametros['becados']['expulsados'] = $becados_expulsados;
            $parametros['becados']['activos'] = $becados_activos;
            $parametros['becados']['suspendidos'] = $becados_suspendido;
            $parametros['becados']['hombres'] = $becados_hombres;
            $parametros['becados']['mujeres'] = $becados_mujeres;
            $parametros['becados']['total'] = $becados;

            $parametros['solicitudes']['no_terminadas'] = $solicitudes_no_terminadas;
            $parametros['solicitudes']['enviadas'] = $solicitudes_enviadas;

            return new ParametroResource($parametros);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parametro  $parametro
     * @return \Illuminate\Http\Response
     */
    public function show(Parametro $parametro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parametro  $parametro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parametro $parametro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parametro  $parametro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parametro $parametro)
    {
        //
    }
}