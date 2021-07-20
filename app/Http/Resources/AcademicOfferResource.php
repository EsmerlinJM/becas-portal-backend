<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AcademicOfferResource extends JsonResource
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
            'career' => $this->career,
            'duration' => $this->duration,
            'language' => $this->language,
            'pensum' => $this->pensum,
            'status'   => $this->active ? "Active" : "Inactive",
            'education_level' => new EducationLevelResource($this->education_level),
            // 'development_area' => new DevelopmentAreaResource($this->development_area),
            'type'  => new AcademicOfferTypeResource($this->type)
        ];
    }
}