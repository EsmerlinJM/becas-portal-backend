<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Tools\Tools;
use App\Models\User;
use App\Models\Profile;
use App\Models\Evaluator;
use App\Models\Coordinator;
use App\Models\Candidate;

class UserListResource extends JsonResource
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
            'name' => $this->getName($this->id),
            'role' => new RoleResource($this->role),
        ];
    }

    function getName($id)
    {
        $user = User::findOrFail($id);
        if($this->isProfileUser($user)) {
            return $user->profile->name;

        } elseif($this->isEvaluador($user)) {
            $evaluador = Evaluator::where('user_id', $user->id)->first();
            return $evaluador->name;

        } elseif($this->isCoordinador($user)) {
            $coordinador = Coordinator::where('user_id', $user->id)->first();
            return $coordinador->name;

        } elseif($this->isCandidato($user)) {
            $candidato = Candidate::where('user_id', $user->id)->first();
            return $candidato->name." ".$candidato->last_name;
        }
    }

    function isProfileUser(User $user)
    {
        if($user->role->id != Tools::EVALUADOR && $user->role->id != Tools::COORDINADOR && $user->role->id != Tools::USUARIO)
        {
            return true;
        } else {
            return false;
        }
    }

    function isEvaluador(User $user)
    {
        if($user->role->id == Tools::EVALUADOR)
        {
            return true;
        } else {
            return false;
        }
    }

    function isCoordinador(User $user)
    {
        if($user->role->id == Tools::COORDINADOR)
        {
            return true;
        } else {
            return false;
        }
    }

    function isCandidato(User $user)
    {
        if($user->role->id == Tools::USUARIO)
        {
            return true;
        } else {
            return false;
        }
    }
}