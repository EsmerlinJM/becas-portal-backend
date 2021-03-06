<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class MunicipalityResource extends JsonResource
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
            'code' => $this->code,
            'identifier' => $this->identifier,
            'region_code' => $this->region_code,
            'name' => $this->name,
            'province' => [
                'id' => $this->province->id,
                'code' => $this->province->code,
                'identifier' => $this->province->identifier,
                'region_code' => $this->province->region_code,
                'name' => $this->province->name,
            ],

        ];
    }
}
