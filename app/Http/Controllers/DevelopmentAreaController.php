<?php

namespace App\Http\Controllers;

use App\Models\EducationLevel;
use App\Models\DevelopmentArea;
use Illuminate\Http\Request;

use App\Http\Resources\DevelopmentAreaResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class DevelopmentAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = DevelopmentArea::all();
        try {
            return DevelopmentAreaResource::collection($areas);
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
        ]);

        try {
            $area = new DevelopmentArea;
            $area->name = $request->name;
            $area->active = 1; //Activo por defecto en creacion
            $area->save();
            return new DevelopmentAreaResource($area);
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
            'development_area_id' => 'required',
        ]);

        $area = DevelopmentArea::findOrFail($request->development_area_id);

        try {
            return new DevelopmentAreaResource($area);
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
            'development_area_id' => 'required',
            'name' => 'required',
        ]);

        $area = DevelopmentArea::findOrFail($request->development_area_id);

        try {
            $area->name = $request->name;
            $area->save();
            return new DevelopmentAreaResource($area);
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
    public function activate(Request $request)
    {
        $request->validate([
            'development_area_id' => 'required',
        ]);

        $area = DevelopmentArea::findOrFail($request->development_area_id);

            if($area->active) {
                throw new AlreadyActive;
            } else {
                try {
                    $area->active = 1; //Activamos
                    $area->save();
                    return new DevelopmentAreaResource($area);
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request)
    {
        $request->validate([
            'development_area_id' => 'required',
        ]);

        $area = DevelopmentArea::findOrFail($request->development_area_id);

            if(!$area->active) {
                throw new AlreadyDeactivated;
            } else {
                try {
                    $area->active = 0; //Desactivamos
                    $area->save();
                    return new DevelopmentAreaResource($area);
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
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
            'development_area_id' => 'required',
        ]);

        $area = DevelopmentArea::findOrFail($request->development_area_id);

        if(EducationLevel::where('development_area_id', $area->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $area->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}