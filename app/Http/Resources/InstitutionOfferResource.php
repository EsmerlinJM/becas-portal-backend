<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class InstitutionOfferResource extends JsonResource
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
            'institution_id' => $this->institution->id,
            'institution_name' => $this->institution->name,
            'institution_image' => $this->institution->image_url,
            'academic_offer_id' => $this->academic_offer->id,
            'academic_offer_name' => $this->academic_offer->career,
            'academic_offer_type' => $this->academic_offer->type->name,
            'education_level_id' => $this->academic_offer->education_level->id,
            'education_level_name' => $this->academic_offer->education_level->name,
            'development_area_id' => $this->academic_offer->education_level->development_area->id,
            'development_area_name' => $this->academic_offer->education_level->development_area->name,
            'detalles' => $this->detalles,
            'campus_id' => $this->campus->id,
            'campus_name' => $this->campus->name,
            'campus_municipality' => $this->campus->municipality->name,
            'campus_province' => $this->campus->province->name,
            'campus_country' => $this->campus->country->name,
        ];
    }
}