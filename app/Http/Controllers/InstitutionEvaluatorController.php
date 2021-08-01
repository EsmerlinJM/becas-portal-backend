<?php

namespace App\Http\Controllers;

use App\Models\InstitutionEvaluator;
use App\Models\Evaluator;
use App\Models\Institution;
use Illuminate\Http\Request;


use App\Http\Resources\InstitutionEvaluatorResource;
use App\Exceptions\SomethingWentWrong;
use App\Tools\Tools;
use App\Tools\ResponseCodes;
use Carbon\Carbon;

class InstitutionEvaluatorController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $request->validate([
            'institution_id' => 'required',
            'evaluator_id' => 'required',
        ]);

        $evaluator = Evaluator::findOrFail($request->evaluator_id);
        $institution = Institution::findOrFail($request->institution_id);

        $check = InstitutionEvaluator::where('evaluator_id', $request->evaluator_id)->where('institution_id', $request->institution_id)->first();

        if(!$check) {
            try {
                $ie = new InstitutionEvaluator;
                $ie->evaluator_id = $evaluator->id;
                $ie->institution_id = $institution->id;
                $ie->save();
                return new InstitutionEvaluatorResource($ie);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Institucion ya se encuentra asignada al evaluador'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        $request->validate([
            'institution_evaluator_id' => 'required',
        ]);

        $ie = InstitutionEvaluator::findOrFail($request->institution_evaluator_id);

        try {
            $ie->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }
}