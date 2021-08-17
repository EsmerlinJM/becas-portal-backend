<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\Convocatoria;
use App\Models\FormularioDetail;
use Illuminate\Http\Request;

use App\Http\Resources\FormularioResource;
use App\Exceptions\SomethingWentWrong;
use App\Tools\Tools;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formularios = Formulario::all();
        try {
            return FormularioResource::collection($formularios);
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
            'description' => 'required',
        ]);

        try {
            $formulario = new Formulario;
            $formulario->name = $request->name;
            $formulario->description = $request->description;
            $formulario->isPlantilla = isset($request->isPlantilla) ? true : false;
            $formulario->save();
            return new FormularioResource($formulario);
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
            'formulario_id' => 'required',
        ]);

        $formulario = Formulario::findOrFail($request->formulario_id);

        try {
            return new FormularioResource($formulario);
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
            'formulario_id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        $formulario = Formulario::findOrFail($request->formulario_id);

        try {
            $formulario->name = $request->name;
            $formulario->description = $request->description;
            $formulario->isPlantilla = isset($request->isPlantilla) ? true : false;
            $formulario->save();
            return new FormularioResource($formulario);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'formulario_id' => 'required',
        ]);

        $formulario = Formulario::findOrFail($request->formulario_id);

        if(Convocatoria::where('formulario_id', $formulario->id)->count() > 0 || $formulario->details()->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $formulario->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}