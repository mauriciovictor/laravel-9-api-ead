<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

// use Illuminate\Support\Carbon;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this->replies);
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_label' => $this->statusOptions[$this->status],
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'lesson' => new LessonResource($this->whenLoaded('users')),
            'replies' => LessonResource::collection($this->whenLoaded('replies')),
            'dt_updated' => Carbon::make($this->updated_at)->format('Y-m-d H:s:i')
        ];
    }
}
