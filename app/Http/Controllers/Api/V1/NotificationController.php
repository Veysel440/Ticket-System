<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Services\NotificationService;

class NotificationController extends Controller
{
    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $notifications = $this->service->getUserNotifications(auth()->id());
        return NotificationResource::collection($notifications);
    }

    public function markAsRead($id)
    {
        $notification = $this->service->markAsRead($id);
        return new NotificationResource($notification);
    }
}
