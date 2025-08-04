<?php

namespace App\Repositories;

use App\Interface\NotificationInterface;
use App\Models\Notification;

class NotificationRepository implements NotificationInterface
{
    public function forUser($userId)
    {
        return Notification::where('notifiable_id', $userId)
            ->where('notifiable_type', 'App\Models\User')
            ->latest()->get();
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);
        return $notification;
    }

    public function create(array $data)
    {
        return Notification::create($data);
    }
}
