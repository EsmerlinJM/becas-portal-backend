<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class InstitutionResource extends JsonResource
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
            'siglas' => $this->siglas,
            'image_url' => $this->image_url,
            'image_ext' => $this->image_ext,
            'image_size' => $this->image_size,
            'type'  => new InstitutionTypeResource($this->type),
            'ofertas' => InstitutionOfferResource::collection($this->ofertas)
        ];
    }
}