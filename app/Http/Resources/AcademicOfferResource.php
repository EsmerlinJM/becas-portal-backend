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
            'pensum_url' => $this->pensum_url,
            'pensum_ext' => $this->pensum_ext,
            'pensum_size' => $this->pensum_size,
            'status'   => $this->active ? "Active" : "Inactive",
            'education_level' => new EducationLevelResource($this->education_level),
            'type'  => new AcademicOfferTypeResource($this->type)
        ];
    }
}