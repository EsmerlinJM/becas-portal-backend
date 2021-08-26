<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use App\Models\Formulario;
use App\Models\FormularioDetail;
use Illuminate\Http\Request;

use App\Http\Resources\FormularioDetailResource;
use App\Http\Resources\FormularioResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\ArrayEmpty;
use App\Tools\ResponseCodes;
use App\Tools\Tools;

class FormularioDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function byFormulario(Request $request)
    {
        $request->validate([
            'formulario_id' => 'required',
        ]);

        $detalles = FormularioDetail::where('formulario_id', $request->formulario_id)->get();
        try {
            return FormularioDetailResource::collection($detalles);
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
            'formulario_detail_id' => 'required',
        ]);

        $detalle = FormularioDetail::findOrFail($request->formulario_detail_id);
        try {
            return new FormularioDetailResource($detalle);
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
            'formulario_detail_id' => 'required',
            'type' => 'required',
            'required' => 'boolean|required',
            'name' => 'required',
            'description' => 'required',
        ]);

        if($request->type == 'checkbox' || $request->type == 'radio' || $request->type == 'select') {
            $request->validate([
                'data' => 'required',
            ]);
        }

        $detalle = FormularioDetail::findOrFail($request->formulario_detail_id);

        try {
            $detalle->type = $request->type;
            $detalle->required = $request->required ? 1 : 0;
            $detalle->name = $request->name;
            $detalle->description = $request->description;
            $detalle->data = $request->data;
            $detalle->save();
            return new FormularioDetailResource($detalle);
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
            'formulario_detail_id' => 'required',
        ]);

        $detalle = FormularioDetail::findOrFail($request->formulario_detail_id);

        if(Convocatoria::where('formulario_id', $detalle->formulario->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $detalle->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}