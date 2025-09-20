<?php

namespace  App\Services\SeoAnalytics;

use Google\Service\Docs;
use Google\Client as GoogleClient;

class FetchGoogleDocument
{

    public function fetchGoogleDocContent($accessToken, $refreshToken, $docId)
    {
        // Create Google Client

        $client = new GoogleClient();

        $client->setAccessToken(['access_token' => $accessToken]);


        // regenerate Access token

        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($refreshToken);
        }

        $docsService = new Docs($client);

        $document = $docsService->documents->get($docId);

        $text = '';

        foreach ($document->getBody()->getContent() as $content) {
            if ($para = $content->getParagraph()) {
                foreach ($para->getElements() as $el) {
                    $text .= $el->getTextRun()->getContent() ?? '';
                }
            }
        }

        return $text;
    }
}
