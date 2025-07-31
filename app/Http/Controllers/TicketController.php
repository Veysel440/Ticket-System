<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Request;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;

class TicketController extends Controller
{
    protected $service;

    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $tickets = $this->service->list($request->all());
        return TicketResource::collection($tickets);
    }

    public function store(TicketStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $ticket = $this->service->create($data);
        return new TicketResource($ticket);
    }

    public function show($id)
    {
        $ticket = $this->service->show($id);
        return new TicketResource($ticket);
    }

    public function update(TicketUpdateRequest $request, $id)
    {
        $ticket = $this->service->update($id, $request->validated());
        return new TicketResource($ticket);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['success' => true]);
    }
}
