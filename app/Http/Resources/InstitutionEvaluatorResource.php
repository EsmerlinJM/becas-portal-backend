<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstitutionEvaluatorResource extends JsonResource
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
            'evaluator_id' => $this->evaluator_id,
            'institution' => [
               'id' => $this->institution->id,
               'type' => $this->institution->type->name,
               'name' => $this->institution->name,
               'siglas' => $this->institution->siglas,
               'image_url' => $this->institution->image_url,
               'image_ext' => $this->institution->image_ext,
               'image_size' => $this->institution->image_size,
            ],
            'convocatoria' => [
                'id' => $this->convocatoria->id,
                'name' => $this->convocatoria->name,
                'status' => $this->convocatoria->status,
                'image_url' => $this->convocatoria->image_url,
                'image_ext' => $this->convocatoria->image_ext,
                'image_size' => $this->convocatoria->image_size,
             ],
        ];
    }
}