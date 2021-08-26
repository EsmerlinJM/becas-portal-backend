<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AplicationMinResource extends JsonResource
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
        ];
    }
}