<?php

namespace App\Services;

use App\Interface\KnowledgeBaseArticleRepositoryInterface;

class KnowledgeBaseArticleService
{
    protected $repository;

    public function __construct(KnowledgeBaseArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->all();
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
