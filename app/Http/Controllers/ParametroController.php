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
use App\Models\AcademicOfferType;
use Illuminate\Http\Request;

use App\Http\Resources\ParametroResource;
use App\Http\Resources\EstadisticasResource;
use App\Http\Resources\ConvocatoriaTypeResource;
use App\Http\Resources\AcademicOfferTypeResource;
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
    public function parametros()
    {

        try {
            $tipos_convocatorias = ConvocatoriaType::all();
            $niveles_educativos = EducationLevel::select('name')->groupBy('name')->get();
            $audiencias = Audience::all();
            $area_desarrollo = DevelopmentArea::all();
            $tipos_ofertas = AcademicOfferType::all();

            $parametros['tipos_convocatorias'] = ConvocatoriaTypeResource::collection($tipos_convocatorias);
            $parametros['niveles_educativos'] = EducationLevelParameterResource::collection($niveles_educativos);
            $parametros['audiencias'] = AudienceResource::collection($audiencias);
            $parametros['area_desarrollo'] = DevelopmentAreaResource::collection($area_desarrollo);
            $parametros['tipos_ofertas'] = AcademicOfferTypeResource::collection($tipos_ofertas);

            return new ParametroResource($parametros);

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }


    public function estadisticas_convocatoria(Request $request)
    {
        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        if(auth()->user()->institution) {
            $institution = auth()->user()->institution->id;

            try {
                $becados = Scholarship::where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $becados_egresados = Scholarship::where('estado','egresado')->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $becados_retirados = Scholarship::where('estado','retirado')->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $becados_expulsados = Scholarship::where('estado','expulsado')->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $becados_activos = Scholarship::where('estado','activo')->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $becados_suspendido = Scholarship::where('estado','suspendido')->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $becados_hombres = Scholarship::where('genero','masculino')->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $becados_mujeres = Scholarship::where('genero','femenino')->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();

                $solicitudes_no_terminadas = Aplication::where('sent', false)->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $solicitudes_enviadas = Aplication::where('sent', true)->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();
                $solicitudes_aprobadas = Aplication::where('aplication_status_id', 6)->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count() + Aplication::where('aplication_status_id', 7)->where('convocatoria_id', $request->convocatoria_id)->where('institution_id', $institution)->count();

                $estadisticas['becados']['egresados'] = $becados_egresados;
                $estadisticas['becados']['retirados'] = $becados_retirados;
                $estadisticas['becados']['expulsados'] = $becados_expulsados;
                $estadisticas['becados']['activos'] = $becados_activos;
                $estadisticas['becados']['suspendidos'] = $becados_suspendido;
                $estadisticas['becados']['hombres'] = $becados_hombres;
                $estadisticas['becados']['mujeres'] = $becados_mujeres;
                $estadisticas['becados']['total'] = $becados;

                $estadisticas['solicitudes']['no_terminadas'] = $solicitudes_no_terminadas;
                $estadisticas['solicitudes']['enviadas'] = $solicitudes_enviadas;
                $estadisticas['solicitudes']['aprobadas'] = $solicitudes_aprobadas;

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } elseif (auth()->user()->offerer) {
            $oferente = auth()->user()->offerer->id;

            try {
                $becados = Scholarship::where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $becados_egresados = Scholarship::where('estado','egresado')->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $becados_retirados = Scholarship::where('estado','retirado')->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $becados_expulsados = Scholarship::where('estado','expulsado')->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $becados_activos = Scholarship::where('estado','activo')->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $becados_suspendido = Scholarship::where('estado','suspendido')->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $becados_hombres = Scholarship::where('genero','masculino')->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $becados_mujeres = Scholarship::where('genero','femenino')->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();

                $solicitudes_no_terminadas = Aplication::where('sent', false)->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $solicitudes_enviadas = Aplication::where('sent', true)->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();
                $solicitudes_aprobadas = Aplication::where('aplication_status_id', 6)->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count() + Aplication::where('aplication_status_id', 7)->where('convocatoria_id', $request->convocatoria_id)->where('offerer_id', $oferente)->count();

                $estadisticas['becados']['egresados'] = $becados_egresados;
                $estadisticas['becados']['retirados'] = $becados_retirados;
                $estadisticas['becados']['expulsados'] = $becados_expulsados;
                $estadisticas['becados']['activos'] = $becados_activos;
                $estadisticas['becados']['suspendidos'] = $becados_suspendido;
                $estadisticas['becados']['hombres'] = $becados_hombres;
                $estadisticas['becados']['mujeres'] = $becados_mujeres;
                $estadisticas['becados']['total'] = $becados;

                $estadisticas['solicitudes']['no_terminadas'] = $solicitudes_no_terminadas;
                $estadisticas['solicitudes']['enviadas'] = $solicitudes_enviadas;
                $estadisticas['solicitudes']['aprobadas'] = $solicitudes_aprobadas;

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            try {
                $becados = Scholarship::where('convocatoria_id', $request->convocatoria_id)->count();
                $becados_egresados = Scholarship::where('estado','egresado')->where('convocatoria_id', $request->convocatoria_id)->count();
                $becados_retirados = Scholarship::where('estado','retirado')->where('convocatoria_id', $request->convocatoria_id)->count();
                $becados_expulsados = Scholarship::where('estado','expulsado')->where('convocatoria_id', $request->convocatoria_id)->count();
                $becados_activos = Scholarship::where('estado','activo')->where('convocatoria_id', $request->convocatoria_id)->count();
                $becados_suspendido = Scholarship::where('estado','suspendido')->where('convocatoria_id', $request->convocatoria_id)->count();
                $becados_hombres = Scholarship::where('genero','masculino')->where('convocatoria_id', $request->convocatoria_id)->count();
                $becados_mujeres = Scholarship::where('genero','femenino')->where('convocatoria_id', $request->convocatoria_id)->count();

                $solicitudes_no_terminadas = Aplication::where('sent', false)->where('convocatoria_id', $request->convocatoria_id)->count();
                $solicitudes_enviadas = Aplication::where('sent', true)->where('convocatoria_id', $request->convocatoria_id)->count();
                $solicitudes_aprobadas = Aplication::where('aplication_status_id', 6)->where('convocatoria_id', $request->convocatoria_id)->count() + Aplication::where('aplication_status_id', 7)->where('convocatoria_id', $request->convocatoria_id)->count();

                $estadisticas['becados']['egresados'] = $becados_egresados;
                $estadisticas['becados']['retirados'] = $becados_retirados;
                $estadisticas['becados']['expulsados'] = $becados_expulsados;
                $estadisticas['becados']['activos'] = $becados_activos;
                $estadisticas['becados']['suspendidos'] = $becados_suspendido;
                $estadisticas['becados']['hombres'] = $becados_hombres;
                $estadisticas['becados']['mujeres'] = $becados_mujeres;
                $estadisticas['becados']['total'] = $becados;

                $estadisticas['solicitudes']['no_terminadas'] = $solicitudes_no_terminadas;
                $estadisticas['solicitudes']['enviadas'] = $solicitudes_enviadas;
                $estadisticas['solicitudes']['aprobadas'] = $solicitudes_aprobadas;

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
        return new EstadisticasResource($estadisticas);

    }

    public function estadisticas_generales() {

        try {
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
            $solicitudes_aprobadas = Aplication::where('aplication_status_id', 6)->count() + Aplication::where('aplication_status_id', 7)->count();


            $estadisticas['candidatos']['mujeres'] = $candidatos_mujeres;
            $estadisticas['candidatos']['hombres'] = $candidatos_hombres;
            $estadisticas['candidatos']['total'] = $candidatos;

            $estadisticas['becados']['egresados'] = $becados_egresados;
            $estadisticas['becados']['retirados'] = $becados_retirados;
            $estadisticas['becados']['expulsados'] = $becados_expulsados;
            $estadisticas['becados']['activos'] = $becados_activos;
            $estadisticas['becados']['suspendidos'] = $becados_suspendido;
            $estadisticas['becados']['hombres'] = $becados_hombres;
            $estadisticas['becados']['mujeres'] = $becados_mujeres;
            $estadisticas['becados']['total'] = $becados;

            $estadisticas['solicitudes']['no_terminadas'] = $solicitudes_no_terminadas;
            $estadisticas['solicitudes']['enviadas'] = $solicitudes_enviadas;
            $estadisticas['solicitudes']['aprobadas'] = $solicitudes_aprobadas;

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

            return new EstadisticasResource($estadisticas);

    }
}
