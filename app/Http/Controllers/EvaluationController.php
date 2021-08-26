<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EvaluationRequirement;
use App\Models\Convocatoria;
use Illuminate\Http\Request;

use App\Http\Resources\EvaluationRequirementResource;
use App\Http\Resources\EvaluationResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\ArrayEmpty;
use App\Tools\ResponseCodes;
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
        $eval =  json_decode($request->getContent());
        $counter = 0;
        $counter2 = 0;
        $requerimientos = null;
        $temporal = null;

        try {
            $evaluacion = new Evaluation;
            $evaluacion->name = $eval->name;
            $evaluacion->color = $eval->color;
            $evaluacion->top_score = $eval->top_score;
            $evaluacion->pre_approved = $eval->pre_approved;
            $evaluacion->isPlanilla = $eval->isPlanilla;
            $evaluacion->save();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

        if($eval) {

            $top_score = $evaluacion->top_score;
            $current_sum = 0;

            foreach ($eval->requerimientos as $item) {

                try {
                    if($current_sum + $item->value <= $top_score) {
                        $requerimiento = new EvaluationRequirement;
                        $requerimiento->evaluation_id = $evaluacion->id;
                        $requerimiento->name = $item->name;
                        $requerimiento->description = $item->description;
                        $requerimiento->value = $item->value;
                        $requerimiento->step_basic = round($item->value/3, 2);
                        $requerimiento->step_medium = round(($item->value/3) * 2, 2);
                        $requerimiento->step_complete = $item->value;
                        // $requerimiento->save(); //Guardamos debajo luego de validar
                        $temporal[$counter] = $requerimiento;

                        $current_sum += $item->value;

                        $counter ++;
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'El valor de los requerimientos sobrepasa sobrepasa el valor total de la evaluacion'], ResponseCodes::UNPROCESSABLE_ENTITY);
                    }

                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            }

            if($current_sum == $top_score) {
                foreach ($temporal as $item) {
                    $item->save();
                    $requerimientos[$counter2] = $item;
                    $counter2 ++;
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'El valor total de los requerimientos no es igual al valor de la evaluacion'], ResponseCodes::UNPROCESSABLE_ENTITY);
            }
            return new EvaluationResource($evaluacion);
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