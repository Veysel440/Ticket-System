<?php

namespace App\Repositories;

use App\Interface\TicketRepositoryInterface;
use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{
    public function filtered(array $filters)
    {
        $query = Ticket::with(['user', 'assignedUser', 'tags', 'comments.user']);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['tag'])) {
            $query->whereHas('tags', fn($q) => $q->where('name', $filters['tag']));
        }

        return $query->latest()->paginate(15);
    }

    public function create(array $data)
    {
        return Ticket::create($data);
    }

    public function findOrFail($id)
    {
        return Ticket::with(['user', 'assignedUser', 'tags', 'comments.user'])->findOrFail($id);
    }
}
