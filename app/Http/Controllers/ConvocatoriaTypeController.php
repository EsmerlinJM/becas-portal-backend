<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use App\Models\ConvocatoriaType;
use Illuminate\Http\Request;

use App\Http\Resources\ConvocatoriaTypeResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;
use Carbon\Carbon;

class ConvocatoriaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $tipos = ConvocatoriaType::all();
            return ConvocatoriaTypeResource::collection($tipos);
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
        ]);

        try {
            $tipo = new ConvocatoriaType;
            $tipo->name = $request->name;
            $tipo->color = $request->color;
            $tipo->save();
            return new ConvocatoriaTypeResource($tipo);
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
            'convocatoria_type_id' => 'required',
        ]);

        $tipo = ConvocatoriaType::findOrFail($request->convocatoria_type_id);
        try {
            return new ConvocatoriaTypeResource($tipo);
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
            'convocatoria_type_id' => 'required',
            'name' => 'required',
            'color' => 'required',
        ]);

        $tipo = ConvocatoriaType::findOrFail($request->convocatoria_type_id);

        try {
            $tipo->name = $request->name;
            $tipo->color = $request->color;
            $tipo->save();
            return new ConvocatoriaTypeResource($tipo);
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
            'convocatoria_type_id' => 'required',
        ]);

        $tipo = ConvocatoriaType::findOrFail($request->convocatoria_type_id);
        if(Convocatoria::where('convocatoria_type_id', $tipo->id)->get()->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $tipo->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}