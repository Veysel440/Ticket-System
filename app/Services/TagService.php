<?php

namespace App\Services;

use App\Repositories\TagRepositoryInterface;

class TagService
{
    protected $repository;

    public function __construct(TagRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->all();
    }

    public function create($name)
    {
        $tag = $this->repository->findByName($name);
        if ($tag) return $tag;
        return $this->repository->create(['name' => $name]);
    }
}
