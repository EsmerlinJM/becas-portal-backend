<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ConvocatoriaResource extends JsonResource
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
            'status' => $this->status,
            'publicada' => $this->published,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'image_url' => $this->image_url,
            'image_ext' => $this->image_ext,
            'image_size' => $this->image_size,
            'informacion' => $this->informacion,
            'coordinator' => new CoordinatorResource2($this->coordinator),
            'evaluation' => new EvaluationResource($this->evaluation),
            'audience'  => new AudienceResource($this->audience),
            'type'  => new ConvocatoriaTypeResource($this->type),
        ];
    }
}