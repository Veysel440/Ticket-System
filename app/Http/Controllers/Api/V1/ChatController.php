<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(protected ChatService $service)
    {
        $this->middleware('auth:sanctum');
    }

    public function index($ticketId)
    {
        return response()->json($this->service->getMessages($ticketId));
    }

    public function store(Request $request, $ticketId)
    {
        $data = $request->validate(['message' => 'required|string']);
        $chat = $this->service->sendMessage($ticketId, auth()->id(), $data['message']);
        return response()->json($chat);
    }
}
