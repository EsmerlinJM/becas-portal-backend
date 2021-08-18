<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\FormularioSeccion;
use App\Models\Convocatoria;
use App\Models\FormularioDetail;
use Illuminate\Http\Request;

use App\Http\Resources\FormularioResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\ArrayEmpty;
use App\Tools\ResponseCodes;
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
        $preguntas =  json_decode($request->getContent());

        $counter = 0;
        $detalles = null;

        $formulario = new Formulario;
        $formulario->name = $preguntas->name;
        $formulario->description = $preguntas->description;
        $formulario->isPlantilla = $preguntas->isPlantilla;
        $formulario->save();

        if($preguntas) {
            foreach ($preguntas->detalles as $item) {

                if($item->type == 'checkbox' || $item->type == 'radio' || $item->type == 'select') {
                    if(!isset($item->data)) {
                        return response()->json(['status' => 'error', 'message' => 'Se necesita el campo data para este tipo de pregunta/input'], ResponseCodes::UNPROCESSABLE_ENTITY);
                    }
                }
                try {

                    $seccion = FormularioSeccion::firstOrCreate(['name' =>  $item->seccion]);

                    $detalle = new FormularioDetail;
                    $detalle->formulario_id = $formulario->id;
                    $detalle->formulario_seccion_id = $seccion->id;
                    $detalle->type = $item->type;
                    $detalle->required = $item->required ? 1 : 0;
                    $detalle->name = $item->name;
                    $detalle->description = $item->description;
                    $detalle->data = isset($item->data) ? $item->data : null;
                    $detalle->save();

                    $detalles[$counter] = $detalle;
                    $counter ++;
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            }
            return new FormularioResource($formulario);
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