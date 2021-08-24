<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConvocatoriaMinResource extends JsonResource
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
            'id' => $this->convocatoria->id,
            'name' => $this->convocatoria->name,
            'status' => $this->convocatoria->status,
            'publicada' => $this->published,
            'start_date' => $this->convocatoria->start_date,
            'end_date' => $this->convocatoria->end_date,
            'image_url' => $this->convocatoria->image_url,
            'image_ext' => $this->convocatoria->image_ext,
            'image_size' => $this->convocatoria->image_size,
            'informacion' => $this->informacion,
            'audience'  => new AudienceResource($this->convocatoria->audience),
            'type'  => new ConvocatoriaTypeResource($this->convocatoria->type),
        ];
    }
}