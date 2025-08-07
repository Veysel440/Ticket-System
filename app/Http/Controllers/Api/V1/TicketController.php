<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketStoreRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(protected TicketService $service)
    {
        $this->middleware(['auth:sanctum', 'active.user', 'log.api']);
        $this->middleware('throttle:60,1');
    }

    public function index(Request $request)
    {
        $tickets = $this->service->list($request->all());
        return TicketResource::collection($tickets);
    }

    public function store(TicketStoreRequest $request)
    {
        $ticket = $this->service->create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);
        return new TicketResource($ticket);
    }

    public function show($id)
    {
        $ticket = $this->service->show($id);
        $this->authorize('view', $ticket);
        return new TicketResource($ticket);
    }

    public function update(TicketUpdateRequest $request, $id)
    {
        $ticket = $this->service->show($id);
        $this->authorize('update', $ticket);

        $ticket = $this->service->update($id, $request->validated());
        return new TicketResource($ticket);
    }

    public function destroy($id)
    {
        $ticket = $this->service->show($id);
        $this->authorize('delete', $ticket);
        $this->service->delete($id);
        return response()->json(['success' => true]);
    }
}
