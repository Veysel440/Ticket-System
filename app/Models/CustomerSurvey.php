<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSurvey extends Model
{
    protected $fillable = [
        'ticket_id', 'rating', 'feedback'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
