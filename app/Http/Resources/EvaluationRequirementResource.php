<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EvaluationRequirementResource extends JsonResource
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
            'evaluation_id' => $this->evaluation_id,
            'description' => $this->description,
            'value' => $this->value,
            'step_basic' => $this->step_basic,
            'step_medium' => $this->step_medium,
            'step_complete' => $this->step_complete,
        ];
    }
}