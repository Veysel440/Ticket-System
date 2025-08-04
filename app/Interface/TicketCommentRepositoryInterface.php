<?php

namespace App\Interface;

interface TicketCommentRepositoryInterface
{
    public function create(array $data);
    public function forTicket($ticketId);
}
