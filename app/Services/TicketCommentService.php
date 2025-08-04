<?php

namespace App\Services;

use App\Interface\TicketCommentRepositoryInterface;

class TicketCommentService
{
    protected $repository;

    public function __construct(TicketCommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function add($data)
    {
        return $this->repository->create($data);
    }

    public function getByTicket($ticketId)
    {
        return $this->repository->forTicket($ticketId);
    }
}
