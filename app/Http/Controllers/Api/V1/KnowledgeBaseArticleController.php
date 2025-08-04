<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\KnowledgeBase\KnowledgeBaseArticleStoreRequest;
use App\Http\Requests\KnowledgeBase\KnowledgeBaseArticleUpdateRequest;
use App\Http\Resources\KnowledgeBaseArticleResource;
use App\Services\KnowledgeBaseArticleService;

class KnowledgeBaseArticleController extends Controller
{
    protected $service;

    public function __construct(KnowledgeBaseArticleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return KnowledgeBaseArticleResource::collection($this->service->list());
    }

    public function store(KnowledgeBaseArticleStoreRequest $request)
    {
        $article = $this->service->create($request->validated());
        return new KnowledgeBaseArticleResource($article);
    }

    public function show($id)
    {
        return new KnowledgeBaseArticleResource($this->service->show($id));
    }

    public function update(KnowledgeBaseArticleUpdateRequest $request, $id)
    {
        $article = $this->service->update($id, $request->validated());
        return new KnowledgeBaseArticleResource($article);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['success' => true]);
    }
}
