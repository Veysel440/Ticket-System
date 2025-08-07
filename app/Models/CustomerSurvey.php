<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerSurvey extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'ticket_id', 'rating', 'feedback'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
