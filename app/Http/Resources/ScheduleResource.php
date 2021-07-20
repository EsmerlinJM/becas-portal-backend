<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ScheduleResource extends JsonResource
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
            'modality' => $this->modality,
            'shift' => $this->shift,
            'days' => $this->days,
            'time' => $this->time,
            'status'   => $this->active ? "Active" : "Inactive",
        ];
    }
}