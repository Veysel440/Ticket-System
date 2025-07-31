<?php

namespace App\Repositories;

use App\Models\Tags;

class TagRepository implements TagRepositoryInterface
{
    public function all()
    {
        return Tags::all();
    }

    public function findByName(string $name)
    {
        return Tags::where('name', $name)->first();
    }

    public function create(array $data)
    {
        return Tags::create($data);
    }
}
