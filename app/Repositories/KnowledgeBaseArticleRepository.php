<?php

namespace App\Repositories;

use App\Models\KnowledgeBaseArticle;

class KnowledgeBaseArticleRepository implements KnowledgeBaseArticleRepositoryInterface
{
    public function all()
    {
        return KnowledgeBaseArticle::with('category')->latest()->get();
    }

    public function find($id)
    {
        return KnowledgeBaseArticle::with('category')->findOrFail($id);
    }

    public function create(array $data)
    {
        return KnowledgeBaseArticle::create($data);
    }

    public function update($id, array $data)
    {
        $article = KnowledgeBaseArticle::findOrFail($id);
        $article->update($data);
        return $article;
    }

    public function delete($id)
    {
        return KnowledgeBaseArticle::destroy($id);
    }
}
