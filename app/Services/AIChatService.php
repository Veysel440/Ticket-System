<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIChatService
{
    public function askBot($message)
    {
        $apiKey = config('services.openai.key');
        $response = Http::withToken($apiKey)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful support assistant.'],
                    ['role' => 'user', 'content' => $message]
                ]
            ]);
        return $response->json('choices.0.message.content');
    }
}
