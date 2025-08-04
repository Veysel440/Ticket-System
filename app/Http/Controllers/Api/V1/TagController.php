<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $service;

    public function __construct(TagService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return TagResource::collection($this->service->list());
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $tag = $this->service->create($request->name);
        return new TagResource($tag);
    }
}
