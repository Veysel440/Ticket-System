<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'assigned_user_id', 'title', 'description', 'status', 'priority'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

    public function survey()
    {
        return $this->hasOne(CustomerSurvey::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'tag_ticket');
    }
}
