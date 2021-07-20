<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipDetail;
use Illuminate\Http\Request;

use App\Http\Resources\ScholarshipDetailResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class ScholarshipDetailController extends Controller
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
     * @param  \App\Models\ScholarshipDetail  $scholarshipDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ScholarshipDetail $scholarshipDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScholarshipDetail  $scholarshipDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScholarshipDetail $scholarshipDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScholarshipDetail  $scholarshipDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScholarshipDetail $scholarshipDetail)
    {
        //
    }
}