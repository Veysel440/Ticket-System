<?php

namespace App\Repositories;

interface TicketCommentRepositoryInterface
{
    public function create(array $data);
    public function forTicket($ticketId);
}
