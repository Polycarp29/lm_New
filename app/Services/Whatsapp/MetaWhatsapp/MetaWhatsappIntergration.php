<?php

namespace  App\Services\Whatsapp\MetaWhatsapp;

use Illuminate\Support\Facades\Http;

class MetaWhatsappIntergration
{


    protected $token;
    protected $phoneNumberId;
    public function construct()
    {
        $this->token = env('WHATSAPP_TOKEN');
        $this->phoneNumberId = env('WHATSAPP_PHONE_NUMBER_ID');
    }


    public function sendMessage($to, $message)
    {
        $url = "https://graph.facebook.com/v19.0/{$this->phoneNumberId}/messages";

        $response = Http::withToken($this->token)->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $to, // in E.164 format: e.g., 15551234567
            'type' => 'text',
            'text' => ['body' => $message],
        ]);


        return $response->json();
    }
}