<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ScholarshipResource extends JsonResource
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
            'becado_name' => $this->name,
            'becado_lastname' => $this->lastname,
            'genero' => $this->genero,
            'estado'   => $this->estado,
            'coverage'  => $this->convocatoria_detail->coverage,
            'convocatoria' => new ConvocatoriaMin2Resource($this->convocatoria),
            'oferente' => new OffererResource($this->offerer),
            'institution' => new InstitutionMinResource($this->institution),
            'institution_offer' => new InstitutionOfferResource($this->institution_offer),
            'candidate' => new CandidateResource($this->candidate),
            'solicitud' => new AplicationMinResource($this->aplication),
            'detalles_becado' => ScholarshipDetailMinResource::collection($this->details)
        ];
    }
}