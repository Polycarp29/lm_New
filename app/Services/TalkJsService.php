<?php

use Illuminate\Support\Facades\Http;

class TalkJsService
{

    protected string $baseUrl;
    protected string $secretKey;


    public function __construct()
    {
        $this->baseUrl = config('talkjs.base_url') . config('talkjs.app_id') . '/';
        $this->secretKey = config('talkjs.secret_key');
    }

    public function fetchConversations()
    {
        // Fetch TalkJs Chats
        $response = Http::withBasicAuth($this->secretKey, '')->get($this->baseUrl . "conversations");
        return $response->json();
    }

    // Send Message

    public function sendMessage($conversationId, $senderId, $message)
    {
        $response = Http::withBasicAuth($this->secretKey, '')
            ->post($this->baseUrl . "conversations/{$conversationId}/messages", [
                'sender' => $senderId,
                'text' => $message,
            ]);

        return $response->json();
    }
}



