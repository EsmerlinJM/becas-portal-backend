<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OfferResource extends JsonResource
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
            'name' => $this->name,
            'user_id' => $this->user->user_id,
            'document_id' => $this->document_id,
            'type' => $this->type,
            'contact_person' => $this->contact_person,
            'contact_number' => $this->contact_number,
            'contact_email'   => $this->contact_email,
        ];
    }
}