<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AplicationDetailResource extends JsonResource
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
            'aplication_id' => $this->aplication_id,
            'evaluation_id' => $this->requirement->evaluation->id,
            'evaluation_requirement_id' => $this->requirement->id,
            'evaluation_requirement_description' => $this->requirement->description,
            'evaluation_requirement_value' => $this->requirement->value,
            'score' => $this->score,
            'notes' => $this->notes,
            'evaluator_id' => $this->evaluator ? $this->evaluator->id : null,
            'evaluator_name' => $this->evaluator ? $this->evaluator->name : null,
            'evaluated_at' => ($this->evaluated_at != null) ? Carbon::parse($this->evaluated_at)->toDateTimeString() : "",
        ];
    }
}