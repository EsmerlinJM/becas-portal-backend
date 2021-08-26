<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScholarshipDetailMinResource extends JsonResource
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
            'rango_maximo' => $this->max_rating,
            'rango_minimo' => $this->min_rating,
            'periodo' => $this->period,
            'calificacion'   => $this->rating,
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}
