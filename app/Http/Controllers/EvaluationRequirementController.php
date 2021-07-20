<?php

namespace App\Http\Controllers;

use App\Models\EvaluationRequirement;
use Illuminate\Http\Request;

use App\Http\Resources\EvaluationRequirementResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class EvaluationRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\EvaluationRequirement  $evaluationRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(EvaluationRequirement $evaluationRequirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EvaluationRequirement  $evaluationRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EvaluationRequirement $evaluationRequirement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EvaluationRequirement  $evaluationRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvaluationRequirement $evaluationRequirement)
    {
        //
    }
}