<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'titulo' => $this->resource->title,
            'cuerpo' => $this->resource->cuerpo,
            'owner' => $this->resource->owner
        ];
    }
}
