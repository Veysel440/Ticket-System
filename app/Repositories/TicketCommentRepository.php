<?php

namespace App\Repositories;

use App\Interface\TicketCommentRepositoryInterface;
use App\Models\TicketComment;

class TicketCommentRepository implements TicketCommentRepositoryInterface
{
    public function create(array $data)
    {
        return TicketComment::create($data);
    }

    public function forTicket($ticketId)
    {
        return TicketComment::where('ticket_id', $ticketId)->with('user')->latest()->get();
    }
}
