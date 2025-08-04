<?php

namespace App\Http\Requests\KnowledgeBase;


use Illuminate\Foundation\Http\FormRequest;

class KnowledgeBaseArticleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'sometimes|exists:knowledge_base_categories,id',
            'title'       => 'sometimes|string|max:255',
            'content'     => 'sometimes|string',
        ];
    }
}
