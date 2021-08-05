<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use App\Models\Evaluation;
use App\Models\EvaluationRequirement;
use Illuminate\Http\Request;

use App\Http\Resources\EvaluationRequirementResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\ArrayEmpty;
use App\Tools\ResponseCodes;
use App\Tools\Tools;

class EvaluationRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function byEvaluacion(Request $request)
    {
        $request->validate([
            'evaluation_id' => 'required',
        ]);

        $requerimientos = EvaluationRequirement::where('evaluation_id', $request->evaluation_id)->get();
        try {
            return EvaluationRequirementResource::collection($requerimientos);
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
        $criterios =  json_decode($request->getContent());
        $counter = 0;
        $counter2 = 0;
        $requerimientos = null;
        $temporal = null;

        if($criterios) {
            $evaluacion = Evaluation::findOrFail($criterios[0]->evaluation_id);
            $top_score = $evaluacion->top_score;
            $current_sum = 0;

            foreach ($criterios as $item) {

                try {
                    if($current_sum + $item->value <= $top_score) {
                        $requerimiento = new EvaluationRequirement;
                        $requerimiento->evaluation_id = $item->evaluation_id;
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
            return EvaluationRequirementResource::collection($requerimientos);
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
            'evaluation_requirement_id' => 'required',
        ]);

        $requerimiento = EvaluationRequirement::findOrFail($request->evaluation_requirement_id);
        try {
            return new EvaluationRequirementResource($requerimiento);
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
            'evaluation_requirement_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'value' => 'required',
        ]);

        $requerimiento = EvaluationRequirement::findOrFail($request->evaluation_requirement_id);

        $evaluacion = $requerimiento->evaluation;

        $top_score = $evaluacion->top_score;
        $current_sum = 0;

        foreach ($evaluacion->requirements as $r) {
            $current_sum += $r->value;
        }

        if(($current_sum - $requerimiento->value) + $request->value <= $top_score) {
            try {
                $requerimiento->name = $request->name;
                $requerimiento->description = $request->description;
                $requerimiento->value = $request->value;
                $requerimiento->step_basic = round($request->value/3, 2);
                $requerimiento->step_medium = round(($request->value/3) * 2, 2);
                $requerimiento->step_complete = $request->value;
                $requerimiento->save();
                return new EvaluationRequirementResource($requerimiento);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'El valor de los requerimientos sobrepasa sobrepasa el valor total de la evaluacion'], ResponseCodes::UNPROCESSABLE_ENTITY);
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
            'evaluation_requirement_id' => 'required',
        ]);

        $requerimiento = EvaluationRequirement::findOrFail($request->evaluation_requirement_id);

        if(Convocatoria::where('evaluation_id', $requerimiento->evaluation->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $requerimiento->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}