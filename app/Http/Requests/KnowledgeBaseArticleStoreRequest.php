<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KnowledgeBaseArticleStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:knowledge_base_categories,id',
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
        ];
    }
}
