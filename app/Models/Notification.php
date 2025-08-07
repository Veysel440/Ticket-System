<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'notifiable_id', 'notifiable_type', 'type', 'content', 'is_read'
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
