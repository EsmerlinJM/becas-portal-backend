<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ExperienciaLaboralResource extends JsonResource
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
            'candidate_id' => $this->candidato->id,
            'empresa' => $this->empresa,
            'posicion' => $this->posicion,
            'telefono' => $this->telefono,
            'tipo_contrato' => $this->tipo_contrato,
            'fecha_entrada' => Carbon::parse($this->fecha_entrada)->toFormattedDateString(),
            'fecha_salida' => $this->fecha_salida ? Carbon::parse($this->fecha_salida)->toFormattedDateString() : null,
            'rango_salarial' => $this->rango_salarial,
            'documento_url' => $this->documento_url,
            'documento_ext' => $this->documento_ext,
            'documento_size' => $this->documento_size,
        ];
    }
}
