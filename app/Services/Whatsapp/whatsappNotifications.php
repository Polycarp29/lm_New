<?php

namespace  App\Services\Whatsapp;

use Twilio\Rest\Client;



class whatsappNotifications{


    public function sendSms(string $to,  string $messageText)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages->create(
            "$to",
            [
                'from' => '+14244761513',
                'body' => $messageText,
            ],
        );
    }

}