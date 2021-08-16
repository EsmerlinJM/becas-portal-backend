<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AplicationResource extends JsonResource
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
            'status' => $this->sent ? $this->status->name : "Solicitud Iniciada",
            'score' => $this->score,
            'notes' => $this->notes,
            'closed'   => $this->closed ? "true" : "false",
            'created' => $this->created_at->toDateTimeString(),
            'convocatoria' => [
                'id' => $this->convocatoria_detail->convocatoria->id,
                'name' => $this->convocatoria_detail->convocatoria->name,
                'start_date' => $this->convocatoria_detail->convocatoria->start_date,
                'end_date' => $this->convocatoria_detail->convocatoria->end_date,
                'status'   => $this->convocatoria_detail->convocatoria->active ? "Active" : "Inactive",
                'image_url' => $this->convocatoria_detail->convocatoria->image_url,
                'image_ext' => $this->convocatoria_detail->convocatoria->image_ext,
                'image_size' => $this->convocatoria_detail->convocatoria->image_size,
                'audience'  => $this->convocatoria_detail->convocatoria->audience->name,
                'type'  => $this->convocatoria_detail->convocatoria->type->name,
            ],
            'offerer' => new OffererResource($this->offerer),
            'oferta_academica' => new ConvocatoriaDetailResource($this->convocatoria_detail),
            'candidate' => new CandidateResource($this->candidate),
            'evaluacion' => AplicationDetailResource::collection($this->details),
            'formulario' => AplicationFormResource::collection($this->forms),
            'documents' => DocumentResource::collection($this->documents),
        ];

    }
}
