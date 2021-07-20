<?php

namespace App\Http\Controllers;

use App\Models\AcademicOffer;
use App\Models\EducationLevel;
use App\Models\DevelopmentArea;
use Illuminate\Http\Request;

use App\Http\Resources\EducationLevelResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class EducationLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = EducationLevel::all();
        try {
            return EducationLevelResource::collection($levels);
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
    public function byArea(Request $request)
    {
        $request->validate([
            'development_area_id' => 'required',
        ]);

        $levels = EducationLevel::where('development_area_id', $request->development_area_id)->get();
        try {
            return EducationLevelResource::collection($levels);
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
            'development_area_id' => 'required',
            'name' => 'required',
        ]);

        DevelopmentArea::findOrFail($request->development_area_id);

        try {
            $level = new EducationLevel;
            $level->development_area_id = $request->development_area_id;
            $level->name = $request->name;
            $level->save();
            return new EducationLevelResource($level);
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
            'education_level_id' => 'required',
        ]);

        $level = EducationLevel::findOrFail($request->education_level_id);

        try {
            return new EducationLevelResource($level);
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
            'education_level_id' => 'required',
            'development_area_id' => 'required',
            'name' => 'required',
        ]);

        $level = EducationLevel::findOrFail($request->education_level_id);
        DevelopmentArea::findOrFail($request->development_area_id);

        try {
            $level->development_area_id = $request->development_area_id;
            $level->name = $request->name;
            $level->save();
            return new EducationLevelResource($level);
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
            'education_level_id' => 'required',
        ]);

        $level = EducationLevel::findOrFail($request->education_level_id);

        if(AcademicOffer::where('education_level_id', $level->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $level->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}