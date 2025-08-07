<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ticket;

class TicketPolicy
{
    public function update(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id
            || $user->id === $ticket->assigned_user_id
            || $user->hasRole('admin');
    }

    public function delete(User $user, Ticket $ticket)
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id
            || $user->id === $ticket->assigned_user_id
            || $user->hasRole('admin');
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['user', 'agent', 'admin']);
    }
}
