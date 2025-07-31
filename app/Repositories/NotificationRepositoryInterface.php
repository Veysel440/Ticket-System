<?php

namespace App\Repositories;

interface NotificationRepositoryInterface
{
    public function forUser($userId);
    public function markAsRead($id);
    public function create(array $data);
}
