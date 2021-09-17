<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MensajesConvocatoriaResource extends JsonResource
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
            'name' => $this->name,
            'iniciada' => $this->iniciada,
            'aprobada' => $this->aprobada,
            'rechazada' => $this->rechazada,
            'evaluacion' => $this->evaluacion,
            'credito' => $this->credito,
        ];
    }
}
