<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BecasResourceCandidato extends JsonResource
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
            'convocatoria' => new ConvocatoriaResourceCandidato($this->convocatoria),
            'oferente' => new OferenteResourceCandidato($this->offerer),
            'institution' => new InstitucionResourceCandidato($this->institution),
            'institution_offer' => new InstitutionOfferResource($this->institution_offer),
            'solicitud' => new SolicitudResourceCandidato($this->aplication),
            'calificaciones' => CalificacionesResourceCandidato::collection($this->details)
        ];
    }
}