<?php

namespace App\Http\Controllers;

use App\Models\Evaluator;
use Illuminate\Http\Request;

use App\Http\Resources\EvaluatorResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class EvaluatorController extends Controller
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
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluator $evaluator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluator $evaluator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluator $evaluator)
    {
        //
    }
}