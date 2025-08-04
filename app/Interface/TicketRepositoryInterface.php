<?php

namespace App\Interface;


interface TicketRepositoryInterface
{
    public function filtered(array $filters);
    public function create(array $data);
    public function findOrFail($id);
}
