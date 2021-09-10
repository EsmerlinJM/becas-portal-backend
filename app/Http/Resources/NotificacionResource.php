<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificacionResource extends JsonResource
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
            'nombre' => $this->name,
            'descripcion' => $this->description,
            'read' => $this->read ? true : false,
            'creada' => $this->created_at->toFormattedDateString(),
        ];
    }
}
