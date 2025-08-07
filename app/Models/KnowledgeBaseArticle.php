<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KnowledgeBaseArticle extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id', 'title', 'content'];

    public function category()
    {
        return $this->belongsTo(KnowledgeBaseCategory::class, 'category_id');
    }
}
