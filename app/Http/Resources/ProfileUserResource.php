<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileUserResource extends JsonResource
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
            'email' => $this->email,
            'role' => new RoleResource($this->role),
            'profile' => new ProfileResource($this->profile),
            'institution' => new InstitutionResourceUser($this->institution),
            'offerer' => new OffererResourceUser($this->offerer),
            // 'notificaciones' => NotificacionResource::collection($this->user->notificaciones),
        ];
    }
}
