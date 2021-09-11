<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class SocioEconomicoResourceFull extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'padre_nombre' => $this->padre_nombre,
            'padre_nivel_educativo' => $this->padre_nivel_educativo,
            'padre_trabaja' => $this->padre_trabaja,
            'padre_lugar_trabajo' => $this->padre_lugar_trabajo,
            'padre_funcion_trabajo' => $this->padre_funcion_trabajo,
            'padre_rango_salarial' => $this->padre_rango_salarial,
            'madre_nombre' => $this->madre_nombre,
            'madre_nivel_educativo' => $this->madre_nivel_educativo,
            'madre_trabaja' => $this->madre_trabaja,
            'madre_lugar_trabajo' => $this->madre_lugar_trabajo,
            'madre_funcion_trabajo' => $this->madre_funcion_trabajo,
            'madre_rango_salarial' => $this->madre_rango_salarial,
            'pago_alquiler' => $this->pago_alquiler,
            'monto_alquiler' => $this->monto_alquiler,
            'vehiculo_propio' => $this->vehiculo_propio,
            'actualizado' => Carbon::parse($this->updated_at)->toFormattedDateString(),
            'candidato' => new CandidateResourceEF($this->candidato),
        ];
    }
}
