<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AplicationFormResource extends JsonResource
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
            'aplication_form_id' => $this->id,
            'aplication_id' => $this->aplication->id,
            'formulario_id' => $this->formulario->formulario->id,
            'formulario_detail_id' => $this->formulario->id,
            'formulario_detail_type' => $this->formulario->type,
            'formulario_detail_required' => $this->formulario->required ? true : false,
            'formulario_detail_name' => $this->formulario->name,
            'formulario_detail_description' => $this->formulario->description,
            'formulario_detail_data' => $this->formulario->data,
            'canditate_answer' => $this->answer,
            'answer_at' => ($this->answer != null) ? Carbon::parse($this->updated_at)->toDateTimeString() : null,
        ];
    }
}