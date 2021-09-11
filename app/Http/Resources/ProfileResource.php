<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'image_url' => $this->image_url,
            'image_ext' => $this->image_ext,
            'image_size' => $this->image_size,
            'name' => $this->name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'notificaciones' => NotificacionResource::collection($this->user->notificaciones),
        ];
    }
}
