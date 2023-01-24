<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CourseResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'modules' => ModuleResource::collection($this->whenLoaded('modules')),
            'image' => $this->image ? Storage::url($this->image) : ''
        ];
    }
}
