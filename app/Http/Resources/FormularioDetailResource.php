<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormularioDetailResource extends JsonResource
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
            'formulario_id' => $this->formulario_id,
            'required' => $this->required ? true : false,
            'seccion'   => $this->seccion->name,
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'data' => $this->data
        ];
    }
}