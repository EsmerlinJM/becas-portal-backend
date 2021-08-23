<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ScholarshipDetailResource extends JsonResource
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
            'rango_maximo' => $this->max_rating,
            'rango_minimo' => $this->min_rating,
            'periodo' => $this->period,
            'calificacion'   => $this->rating,
            'created_at' => $this->created_at->toDateTimeString(),
            'convocatoria' => new ConvocatoriaMin2Resource($this->convocatoria),
            'offerer'   => new OffererResource($this->offerer),
            'institution' => new InstitutionMinResource($this->institution),
            'institution_offer' => new InstitutionOfferResource($this->institution_offer),
            'candidadte' => new CandidateResource($this->candidate),
            'solicitud' => new AplicationMinResource($this->aplication)

        ];
    }
}
