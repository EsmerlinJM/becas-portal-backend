<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileEvaluatorResource extends JsonResource
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
            'id' => $this->user->id,
            'email' => $this->user->email,
            'role' => new RoleResource($this->user->role),
            'institution' => new InstitutionResourceUser($this->user->institution),
            'offerer' => new OffererResourceUser($this->user->offerer),
            'profile' => [
                'id' => $this->id,
                'evaluator_id' => $this->id,
                'image_url' => $this->image_url,
                'image_ext' => $this->image_ext,
                'image_size' => $this->image_size,
                'name' => $this->name,
                'contact_phone' => $this->contact_phone,
                'contact_email' => $this->contact_email,
                'coordinator_id' => $this->coordinator->id,
                'coordinator_name' => $this->coordinator->name,
                'notificaciones' => NotificacionResource::collection($this->user->notificaciones),
            ]
        ];
    }
}