<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationResourceSolicitud extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);\
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'top_score' => $this->top_score,
            'isPlanilla' => $this->isPlanilla ? true : false,
        ];
    }
}