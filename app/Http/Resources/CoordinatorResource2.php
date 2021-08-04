<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoordinatorResource2 extends JsonResource
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
            'user_id' => $this->user_id,
            'image_url' => $this->image_url,
            'image_ext' => $this->image_ext,
            'image_size' => $this->image_size,
            'name' => $this->name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
        ];
    }
}