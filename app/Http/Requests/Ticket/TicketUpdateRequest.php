<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'            => 'sometimes|string|max:255',
            'description'      => 'sometimes|string',
            'status'           => 'sometimes|in:open,closed,pending,cancelled',
            'priority'         => 'sometimes|in:low,normal,high',
            'tags'             => 'array',
            'tags.*'           => 'string',
            'assigned_user_id' => 'nullable|exists:users,id',
        ];
    }
}
