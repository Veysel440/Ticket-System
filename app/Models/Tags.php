<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tags extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];

    public function ticket()
    {
        return $this->belongsToMany(Ticket::class, 'tag_ticket');
    }
}
