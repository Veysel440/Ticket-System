<?php

namespace App\Interface;

interface NotificationInterface
{
    public function forUser($userId);
    public function markAsRead($id);
    public function create(array $data);
}
