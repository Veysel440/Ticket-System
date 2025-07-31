<?php

namespace App\Services;

use App\Repositories\NotificationRepositoryInterface;

class NotificationService
{
    protected $repository;

    public function __construct(NotificationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUserNotifications($userId)
    {
        return $this->repository->forUser($userId);
    }

    public function markAsRead($id)
    {
        return $this->repository->markAsRead($id);
    }
}
