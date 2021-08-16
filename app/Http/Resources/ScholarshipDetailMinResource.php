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
            'max_rating' => $this->max_rating,
            'min_rating' => $this->min_rating,
            'period' => $this->period,
            'rating'   => $this->rating,
            'created_at' => $this->created_at->toDateTimeString()
        ];
    }
}