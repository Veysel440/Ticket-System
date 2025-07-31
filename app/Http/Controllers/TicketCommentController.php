<?php

namespace App\Http\Controllers;

use App\Services\TicketCommentService;
use App\Http\Resources\TicketCommentResource;
use Illuminate\Http\Request;

class TicketCommentController extends Controller
{
    protected $service;

    public function __construct(TicketCommentService $service)
    {
        $this->service = $service;
    }

    public function index($ticketId)
    {
        return TicketCommentResource::collection($this->service->getByTicket($ticketId));
    }

    public function store(Request $request, $ticketId)
    {
        $data = $request->validate(['comment' => 'required|string']);
        $data['ticket_id'] = $ticketId;
        $data['user_id'] = auth()->id();

        $comment = $this->service->add($data);
        return new TicketCommentResource($comment->load('user'));
    }
}
