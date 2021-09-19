<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use App\Models\MensajesConvocatoria;
use Illuminate\Http\Request;

use App\Http\Resources\MensajesConvocatoriaResource;
use App\Exceptions\SomethingWentWrong;
use App\Tools\Tools;


class MensajesConvocatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $mensajes = MensajesConvocatoria::all();
            return MensajesConvocatoriaResource::collection($mensajes);
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
            'iniciada' => 'required',
            'aprobada' => 'required',
            'rechazada' => 'required',
            'evaluacion' => 'required',
            'credito' => 'required',
        ]);

        try {
            $mensaje = new MensajesConvocatoria;
            $mensaje->fill($request->all());
            $mensaje->save();
            return new MensajesConvocatoriaResource($mensaje);
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
            'mensaje_id' => 'required',
        ]);

        $mensaje = MensajesConvocatoria::findOrFail($request->mensaje_id);

        try {

            return new MensajesConvocatoriaResource($mensaje);
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
            'mensaje_id' => 'required',
            'name' => 'required',
            'iniciada' => 'required',
            'aprobada' => 'required',
            'rechazada' => 'required',
            'evaluacion' => 'required',
            'credito' => 'required',
        ]);

        $mensaje = MensajesConvocatoria::findOrFail($request->mensaje_id);

        try {
            $mensaje->fill($request->all());
            $mensaje->save();
            return new MensajesConvocatoriaResource($mensaje);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MensajesConvocatoria  $mensajesConvocatoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'mensaje_id' => 'required',
        ]);

        $mensaje = MensajesConvocatoria::findOrFail($request->mensaje_id);

        if(Convocatoria::where('mensajes_convocatoria_id', $mensaje->id)->get()->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $mensaje->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}
