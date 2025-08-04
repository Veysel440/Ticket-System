<?php

namespace App\Interface;

interface TagRepositoryInterface
{
    public function all();
    public function findByName(string $name);
    public function create(array $data);
}
