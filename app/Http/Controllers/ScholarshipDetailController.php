<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\ScholarshipDetail;
use Illuminate\Http\Request;

use App\Http\Resources\ScholarshipDetailResource;
use App\Http\Resources\CalificacionesResourceCandidato;
use App\Exceptions\RatingInferior;
use App\Exceptions\RatingOverFlow;
use App\Exceptions\RatingUnderFlow;
use App\Exceptions\BecaInactiva;
use App\Exceptions\SomethingWentWrong;
use App\Tools\Tools;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ScholarshipDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalles = ScholarshipDetail::paginate(30);
        try {
            return ScholarshipDetailResource::collection($detalles);
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
    public function becado(Request $request)
    {
        $request->validate([
            'beca' => 'required',
        ]);

        $usuario = auth()->user();
        if($usuario->candidate){
            $detalles = ScholarshipDetail::where('candidate_id', $usuario->candidate->id)->where('scholarship_id', $request->beca)->get();
            try {
                return CalificacionesResourceCandidato::collection($detalles);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            throw new NotCandidate();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {

        $detalles = ScholarshipDetail::paginate(30);

        if($request->candidate_id) {
            $detalles = ScholarshipDetail::where('candidate_id', $request->candidate_id)->paginate(30);
        }

        if($request->scholarship_id) {
            $detalles = ScholarshipDetail::where('scholarship_id', $request->scholarship_id)->paginate(30);
        }

        try {
            return ScholarshipDetailResource::collection($detalles);
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
        $request->validate([
            'scholarship_id' => 'required',
            'rango_maximo' => 'required|numeric',
            'rango_minimo' => 'required|numeric',
            'periodo' => 'required',
            'calificacion' => 'required|numeric',
        ]);

        $beca = Scholarship::findOrFail($request->scholarship_id);

        if($beca->estado != 'activo') {
            throw new BecaInactiva();
        }

        if($request->rango_minimo >= $request->rango_maximo) {
            throw new RatingInferior();
        }

        if($request->calificacion > $request->rango_maximo) {
            throw new RatingOverFlow();
        }

        if($request->calificacion < $request->rango_minimo) {
            throw new RatingUnderFlow();
        }

        try {
            $detalle = new ScholarshipDetail;
            $detalle->scholarship_id = $beca->id;
            $detalle->max_rating = $request->rango_maximo;
            $detalle->min_rating = $request->rango_minimo;
            $detalle->period = $request->periodo;
            $detalle->rating = $request->calificacion;
            $detalle->convocatoria_id = $beca->convocatoria->id;
            $detalle->convocatoria_detail_id = $beca->convocatoria_detail->id;
            $detalle->offerer_id = $beca->offerer->id;
            $detalle->institution_id = $beca->institution->id;
            $detalle->institution_offer_id = $beca->institution_offer->id;
            $detalle->candidate_id = $beca->candidate->id;
            $detalle->aplication_id = $beca->aplication->id;
            $detalle->save();
            return new ScholarshipDetailResource($detalle);
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
            'scholarship_detail_id' => 'required',
        ]);

        $detalle = ScholarshipDetail::findOrFail($request->scholarship_detail_id);

        try {
            return new ScholarshipDetailResource($detalle);
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
            'scholarship_detail_id' => 'required',
            'rango_maximo' => 'required|numeric',
            'rango_minimo' => 'required|numeric',
            'periodo' => 'required',
            'calificacion' => 'required|numeric',
        ]);

        $detalle = ScholarshipDetail::findOrFail($request->scholarship_detail_id);

        if($detalle->scholarship->estado != 'activo') {
            throw new BecaInactiva();
        }

        if($request->rango_minimo >= $request->rango_maximo) {
            throw new RatingInferior();
        }

        if($request->calificacion > $request->rango_maximo) {
            throw new RatingOverFlow();
        }

        if($request->calificacion < $request->rango_minimo) {
            throw new RatingUnderFlow();
        }

        try {
            $detalle->max_rating = $request->rango_maximo;
            $detalle->min_rating = $request->rango_minimo;
            $detalle->period = $request->periodo;
            $detalle->rating = $request->calificacion;
            $detalle->save();
            return new ScholarshipDetailResource($detalle);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
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
            'scholarship_detail_id' => 'required',
        ]);

        $detalle = ScholarshipDetail::findOrFail($request->scholarship_detail_id);

        if($detalle->scholarship->estado != 'activo') {
            throw new BecaInactiva();
        }

        try {
            $detalle->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }
}