<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Profile;
use App\Models\Evaluator;
use App\Models\Coordinator;
use App\Models\Candidate;
use App\Tools\Tools;

class MensajesBackOfficeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if($this->usuario->role->id == Tools::ADMIN || $this->usuario->role->id == Tools::INSTITUCION || $this->usuario->role->id == Tools::OFERTANTE) {
            $user = Profile::where('user_id', $this->usuario->id)->first();
        } elseif($this->usuario->role->id == Tools::EVALUADOR) {
            $user = Evaluator::where('user_id', $user->id)->first();
        } elseif($this->usuario->role->id == Tools::COORDINADOR) {
            $user = Coordinator::where('user_id', $this->usuario->id)->first();
        } elseif($this->usuario->role->id == Tools::USUARIO) {
            $user = Candidate::where('user_id', $this->usuario->id)->first();
        } else {

        }

        return [
            'id' => $this->id,
            'id_candidato' => $this->candidato->id,
            ($this->type == 'recibido') ? 'from' : 'to' => $this->candidato->name . " " . $this->candidato->last_name,
            ($this->type == 'recibido') ? 'to' : 'from' => $user->name,
            // 'from' => Profile::find($this->usuario->id)->first()->name,
            'subject' => $this->subject,
            'message' => $this->message,
            'estado' => $this->read ? "read" : "unread",
            'tipo' => $this->type,
            'received' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
