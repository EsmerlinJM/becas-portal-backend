<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ConvocatoriaDetailResource extends JsonResource
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
            'convocatoria_id' => $this->convocatoria_id,
            'coverage' => $this->coverage,
            'image_url' => $this->image_url,
            'image_ext' => $this->image_ext,
            'image_size' => $this->image_size,
            'schedule'  => new ScheduleResource($this->schedule),
            'offerer'   => new OffererResource($this->offerer),
            'campus'    => new CampusResource($this->campus),
            'institution' => new InstitutionResource($this->institution),
            'academic_offer' => new AcademicOfferResource($this->academic_offer),
        ];
    }
}