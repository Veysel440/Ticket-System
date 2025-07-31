<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'type'        => $this->type,
            'content'     => $this->content,
            'is_read'     => $this->is_read,
            'created_at'  => $this->created_at,
            'notifiable'  => [
                'id'   => $this->notifiable_id,
                'type' => $this->notifiable_type
            ],
        ];
    }
}
