<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'description'=> $this->description,
            'status'     => $this->status,
            'priority'   => $this->priority,
            'user'       => new UserResource($this->whenLoaded('user')),
            'assigned_user' => new UserResource($this->whenLoaded('assignedUser')),
            'tags'       => TagResource::collection($this->whenLoaded('tags')),
            'comments'   => TicketCommentResource::collection($this->whenLoaded('comments')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

