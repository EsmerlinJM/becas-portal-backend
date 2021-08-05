<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use App\Models\ConvocatoriaType;
use App\Models\EducationLevel;
use App\Models\Audience;
use App\Models\InstitutionOffer;
use App\Models\DevelopmentArea;
use Illuminate\Http\Request;

use App\Http\Resources\ParametroResource;
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
        $tipos_convocatorias = ConvocatoriaType::all();
        $niveles_educativos = EducationLevel::all();
        $audiencias = Audience::all();
        $ofertas_academicas = InstitutionOffer::all();
        $area_desarrollo = DevelopmentArea::all();

        $parametros['tipos_convocatorias'] = $tipos_convocatorias;
        $parametros['niveles_educativos'] = $niveles_educativos;
        $parametros['audiencias'] = $audiencias;
        $parametros['ofertas_academicas'] = $ofertas_academicas;
        $parametros['area_desarrollo'] = $area_desarrollo;

        return new ParametroResource($parametros);
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