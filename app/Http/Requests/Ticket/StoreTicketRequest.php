<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'tags'             => 'array',
            'tags.*'           => 'string',
            'assigned_user_id' => 'nullable|exists:users,id',
            'priority'         => 'nullable|in:low,normal,high',
        ];
    }
}
