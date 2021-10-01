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
            'creditos' => $this->creditos,
            'esfuerzo' => $this->esfuerzo,
            'costo' => $this->costo,
            'pensum_url' => $this->pensum_url,
            'pensum_ext' => $this->pensum_ext,
            'pensum_size' => $this->pensum_size,
            'detalles' => $this->detalles,
            'status'   => $this->active ? "Active" : "Inactive",
            'education_level' => new EducationLevelResource($this->education_level),
            'type'  => new AcademicOfferTypeResource($this->type)
        ];
    }
}