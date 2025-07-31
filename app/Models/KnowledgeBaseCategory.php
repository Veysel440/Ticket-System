<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class KnowledgeBaseCategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function articles()
    {
        return $this->hasMany(KnowledgeBaseArticle::class, 'category_id');
    }
}
