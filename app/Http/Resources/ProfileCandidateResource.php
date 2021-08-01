<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProfileCandidateResource extends JsonResource
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
            'document_id' => $this->document_id,
            'image_url' => $this->image_url,
            'image_ext' => $this->image_ext,
            'image_size' => $this->image_size,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'born_date' => isset($this->born_date) ? Carbon::parse($this->born_date)->toFormattedDateString() : null,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'address' => $this->address,
            'municipality' => new MunicipalityResource($this->municipality),
            'province' => new ProvinceResource($this->province),
            'country' => new CountryResource($this->country),
            'user'  => new UserResource($this->user),
        ];
    }
}