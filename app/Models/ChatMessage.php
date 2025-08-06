<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['ticket_id', 'sender_id', 'message', 'is_bot'];

    public function sender() { return $this->belongsTo(User::class, 'sender_id'); }
    public function ticket() { return $this->belongsTo(Ticket::class); }
}
