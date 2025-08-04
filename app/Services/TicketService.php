<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;
use App\Interface\TicketRepositoryInterface;

class TicketService
{
    public function __construct(protected TicketRepositoryInterface $repository) {}


    public function list($filters = [])
    {
        return $this->repository->filtered($filters);
    }


    public function create(array $data)
    {
        return DB::transaction(function() use ($data) {
            $ticket = $this->repository->create([
                'user_id'          => $data['user_id'],
                'title'            => $data['title'],
                'description'      => $data['description'],
                'status'           => $data['status'] ?? 'open',
                'priority'         => $data['priority'] ?? 'normal',
                'assigned_user_id' => $data['assigned_user_id'] ?? null,
            ]);


            if (!empty($data['tags'])) {
                $tagIds = collect($data['tags'])->map(fn($name) =>
                Tags::firstOrCreate(['name' => $name])->id
                );
                $ticket->tags()->sync($tagIds);
            }

            if (method_exists($ticket, 'user') && $ticket->user) {
                $ticket->user->notifications()->create([
                    'type'    => 'system',
                    'content' => 'Destek talebiniz oluşturuldu.',
                ]);
            }
            if ($ticket->assigned_user_id && method_exists($ticket, 'assignedUser') && $ticket->assignedUser) {
                $ticket->assignedUser->notifications()->create([
                    'type'    => 'system',
                    'content' => 'Yeni bir destek talebi size atandı.',
                ]);
            }

            return $ticket->load(['user', 'assignedUser', 'tags']);
        });
    }

    public function show($id)
    {
        return $this->repository->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function() use ($id, $data) {
            $ticket = $this->repository->findOrFail($id);
            $ticket->update([
                'title'            => $data['title']          ?? $ticket->title,
                'description'      => $data['description']    ?? $ticket->description,
                'status'           => $data['status']         ?? $ticket->status,
                'priority'         => $data['priority']       ?? $ticket->priority,
                'assigned_user_id' => $data['assigned_user_id'] ?? $ticket->assigned_user_id,
            ]);

            if (!empty($data['tags'])) {
                $tagIds = collect($data['tags'])->map(fn($name) =>
                Tags::firstOrCreate(['name' => $name])->id
                );
                $ticket->tags()->sync($tagIds);
            }

            return $ticket->load(['user', 'assignedUser', 'tags', 'comments.user']);
        });
    }

    public function delete($id)
    {
        $ticket = $this->repository->findOrFail($id);
        $ticket->delete();
        return true;
    }
}
