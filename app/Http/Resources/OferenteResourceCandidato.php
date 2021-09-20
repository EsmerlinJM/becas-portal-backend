<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OferenteResourceCandidato extends JsonResource
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
            'type' => $this->type,
            'name' => $this->name,
            'document_id' => $this->document_id,
            'contact_person' => $this->contact_person,
            'contact_number' => $this->contact_number,
            'contact_email'   => $this->contact_email,
            'image_url' => $this->image_url,
            'image_ext' => $this->image_ext,
            'image_size' => $this->image_size,
        ];
    }
}