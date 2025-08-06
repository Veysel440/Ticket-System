<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function __construct(protected FileUploadService $service)
    {
        $this->middleware('auth:sanctum');
    }

    public function upload(Request $request)
    {
        $data = $request->validate(['file' => 'required|file|max:5120']);
        $path = $this->service->upload($request->file('file'));
        return response()->json(['url' => Storage::url($path)]);
    }
}
