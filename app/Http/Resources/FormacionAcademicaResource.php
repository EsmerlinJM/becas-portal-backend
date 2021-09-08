<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class FormacionAcademicaResource extends JsonResource
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
            'carrera' => $this->carrera,
            'institucion' => $this->institucion,
            'isBecado' => $this->isBecado ? true : false,
            'fecha_entrada' => Carbon::parse($this->fecha_entrada)->toFormattedDateString(),
            'fecha_salida' => $this->fecha_salida ? Carbon::parse($this->fecha_salida)->toFormattedDateString() : null,
            'indice' => $this->indice,
            'certificacion_url' => $this->certificacion_url,
            'certificacion_ext' => $this->certificacion_ext,
            'certificacion_size' => $this->certificacion_size,
        ];
    }
}