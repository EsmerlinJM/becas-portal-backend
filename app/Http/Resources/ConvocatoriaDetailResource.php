<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ConvocatoriaDetailResource extends JsonResource
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
            'convocatoria_id' => $this->convocatoria_id,
            'coverage' => $this->coverage,
            'image_url' => $this->image_url,
            'image_ext' => $this->image_ext,
            'image_size' => $this->image_size,
            'requisitos' => $this->convocatoria->requisitos,
            'color' => $this->convocatoria->type->color,
            'institucion' => new InstitutionMinResource($this->institution),
            'offerer'   => new OffererResource($this->offerer),
            'oferta' => new InstitutionOfferResource($this->oferta),
            'formulario' => new FormularioResource($this->formulario),
        ];
    }
}