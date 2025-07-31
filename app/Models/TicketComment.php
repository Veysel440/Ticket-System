<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    protected $fillable = [
        'ticket_id', 'user_id', 'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
