<?php

namespace App\Services\Plagarism;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;



class CopyLeaksService
{
    // Initiate Variables
    protected $email;
    protected $apiKey;
    protected $authToken;

    public function __construct()
    {
        $this->email = env('COPYLEAKS_EMAIL');
        $this->apiKey = env('COPYLEAKS_API_KEY');
    }

    public function authenticate()
    {
        $response = Http::post('https://id.copyleaks.com/v3/account/login/api', [
            'email' => $this->email,
            'key' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $this->authToken = $response['access_token'];
            return $this->authToken;
        }

        throw new \Exception('CopyLeaks auth failed: ' . $response->body());
    }

    public function submitTextScan(string $text)
    {
        $this->authenticate();

        $scanId = uniqid('scan_', true);


        $response = Http::withToken($this->authToken)
            ->put("https://api.copyleaks.com/v3/scans/submit/file/$scanId", [
                'base64' => base64_encode($text),
                'filename' => 'seo-submitted.txt',
                'properties' => [
                    'sandbox' => true, // true for testing; switch to false in prod
                    'webhooks' => [
                        'status' => route('copyleaks.webhook.status', ['scanId' => $scanId]),
                        'completed' => route('copyleaks.webhook.completed', ['scanId' => $scanId]),
                    ],
                ]
            ]);

        if (!$response->successful()) {
            throw new \Exception('CopyLeaks scan submission failed: ' . $response->body());
        }

        return [
            'scan_id' => $scanId,
            'status' => 'submitted',
        ];
    }

}
