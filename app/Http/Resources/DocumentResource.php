<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class DocumentResource extends JsonResource
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
            'candidate_id' => $this->candidate_id,
            'aplication_id' => $this->aplication_id,
            'name' => $this->name,
            'notes' => $this->notes,
            'url' => $this->url,
            'extension' => $this->ext,
            'size' => $this->size,
            'created' => Carbon::parse($this->created_at)->toDateTimeString(),
        ];
    }
}
