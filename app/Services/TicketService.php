<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;

class TicketService
{
    public function list($filters = [])
    {
        $query = Ticket::with(['user', 'assignedUser', 'tags', 'comments.user']);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (isset($filters['tag'])) {
            $query->whereHas('tags', fn($q) => $q->where('name', $filters['tag']));
        }

        return $query->latest()->paginate(15);
    }

    public function create($data)
    {
        return DB::transaction(function() use ($data) {
            $ticket = Ticket::create([
                'user_id'         => $data['user_id'],
                'title'           => $data['title'],
                'description'     => $data['description'],
                'status'          => $data['status'] ?? 'open',
                'priority'        => $data['priority'] ?? 'normal',
                'assigned_user_id'=> $data['assigned_user_id'] ?? null,
            ]);


            if (!empty($data['tags'])) {
                $tagIds = collect($data['tags'])->map(function($name) {
                    return Tags::firstOrCreate(['name' => $name])->id;
                });
                $ticket->tags()->sync($tagIds);
            }


            $ticket->user->notifications()->create([
                'type'    => 'system',
                'content' => 'Destek talebiniz oluşturuldu.',
            ]);
            if ($ticket->assigned_user_id) {
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
        return Ticket::with(['user', 'assignedUser', 'tags', 'comments.user'])->findOrFail($id);
    }

    public function update($id, $data)
    {
        return DB::transaction(function() use ($id, $data) {
            $ticket = Ticket::findOrFail($id);

            $ticket->update([
                'title'           => $data['title'] ?? $ticket->title,
                'description'     => $data['description'] ?? $ticket->description,
                'status'          => $data['status'] ?? $ticket->status,
                'priority'        => $data['priority'] ?? $ticket->priority,
                'assigned_user_id'=> $data['assigned_user_id'] ?? $ticket->assigned_user_id,
            ]);

            if (!empty($data['tags'])) {
                $tagIds = collect($data['tags'])->map(function($name) {
                    return Tags::firstOrCreate(['name' => $name])->id;
                });
                $ticket->tags()->sync($tagIds);
            }

            return $ticket->load(['user', 'assignedUser', 'tags', 'comments.user']);
        });
    }

    public function delete($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return true;
    }
}
