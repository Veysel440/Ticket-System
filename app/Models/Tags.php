<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = ['name'];

    public function ticket()
    {
        return $this->belongsToMany(Ticket::class, 'tag_ticket');
    }
}
