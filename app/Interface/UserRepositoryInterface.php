<?php

namespace App\Interface;

interface UserRepositoryInterface
{
    public function all();
    public function find($id);
}
