<?php

namespace App\Services;

use App\Models\ChatMessage;

class ChatService
{
    public function getMessages($ticketId)
    {
        return ChatMessage::where('ticket_id', $ticketId)->with('sender')->orderBy('created_at')->get();
    }

    public function sendMessage($ticketId, $userId, $message, $isBot = false)
    {
        return ChatMessage::create([
            'ticket_id' => $ticketId,
            'sender_id' => $userId,
            'message'   => $message,
            'is_bot'    => $isBot,
        ]);
    }
}
