<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AIChatService;
use Illuminate\Http\Request;

class AIChatController extends Controller
{
    public function __construct(protected AIChatService $service)
    {
        $this->middleware('auth:sanctum');
    }

    public function ask(Request $request)
    {
        $data = $request->validate(['message' => 'required|string|max:500']);
        $answer = $this->service->askBot($data['message']);
        return response()->json(['reply' => $answer]);
    }
}
