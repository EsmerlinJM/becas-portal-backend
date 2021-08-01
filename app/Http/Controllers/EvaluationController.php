<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Convocatoria;
use Illuminate\Http\Request;

use App\Http\Resources\EvaluationResource;
use App\Exceptions\SomethingWentWrong;
use App\Tools\Tools;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluaciones = Evaluation::all();
        try {
            return EvaluationResource::collection($evaluaciones);
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
            'name' => 'required',
            'color' => 'required',
            'top_score' => 'required',
            'pre_approved' => 'required',
        ]);

        try {
            $evaluacion = new Evaluation;
            $evaluacion->name = $request->name;
            $evaluacion->color = $request->color;
            $evaluacion->top_score = $request->top_score;
            $evaluacion->pre_approved = $request->pre_approved;
            $evaluacion->save();
            return new EvaluationResource($evaluacion);
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
            'evaluation_id' => 'required',
        ]);

        $evaluacion = Evaluation::findOrFail($request->evaluation_id);

        try {
            return new EvaluationResource($evaluacion);
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
            'evaluation_id' => 'required',
            'name' => 'required',
            'color' => 'required',
            'top_score' => 'required',
            'pre_approved' => 'required',
        ]);

        $evaluacion = Evaluation::findOrFail($request->evaluation_id);

        try {
            $evaluacion->name = $request->name;
            $evaluacion->color = $request->color;
            $evaluacion->top_score = $request->top_score;
            $evaluacion->pre_approved = $request->pre_approved;
            $evaluacion->save();
            return new EvaluationResource($evaluacion);
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
            'evaluation_id' => 'required',
        ]);

        $evaluacion = Evaluation::findOrFail($request->evaluation_id);

        if(Convocatoria::where('evaluation_id', $evaluacion->id)->count() > 0 || $evaluacion->requirements()->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $evaluacion->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}