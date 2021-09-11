<?php

namespace App\Http\Controllers;

use App\Models\SocioEconomico;
use Illuminate\Http\Request;

use App\Http\Resources\SocioEconomicoResourceFull;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotBelongsTo;
use App\Exceptions\NotSocioEconomico;
use App\Tools\Tools;
use Carbon\Carbon;

class SocioEconomicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $model = SocioEconomico::where('candidate_id', auth()->user()->candidate->id)->first();
            return new SocioEconomicoResourceFull($model);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocioEconomico  $socioEconomico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $economico = SocioEconomico::where('candidate_id', auth()->user()->candidate->id)->first();

        if(!$economico) {
            throw new NotSocioEconomico();
        }
        $this->belongsToUser($economico);

        try {
            $economico->padre_nombre = $request->padre_nombre;
            $economico->padre_nivel_educativo = $request->padre_nivel_educativo;
            $economico->padre_trabaja = $request->padre_trabaja;
            $economico->padre_lugar_trabajo = $request->padre_lugar_trabajo;
            $economico->padre_funcion_trabajo = $request->padre_funcion_trabajo;
            $economico->padre_rango_salarial = $request->padre_rango_salarial;
            $economico->madre_nombre = $request->madre_nombre;
            $economico->madre_nivel_educativo = $request->madre_nivel_educativo;
            $economico->madre_trabaja = $request->madre_trabaja;
            $economico->madre_lugar_trabajo = $request->madre_lugar_trabajo;
            $economico->madre_funcion_trabajo = $request->madre_funcion_trabajo;
            $economico->madre_rango_salarial = $request->madre_rango_salarial;
            $economico->pago_alquiler = $request->pago_alquiler;
            $economico->monto_alquiler = $request->monto_alquiler;
            $economico->vehiculo_propio = $request->vehiculo_propio;
            $economico->save();

            return new SocioEconomicoResourceFull($economico);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    public static function belongsToUser(SocioEconomico $economico)
    {
        if ( auth()->user()->candidate->id == $economico->candidato->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}
