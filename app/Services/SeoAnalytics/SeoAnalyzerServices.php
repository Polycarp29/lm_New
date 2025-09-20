<?php

namespace App\Services\SeoAnalytics;
use Illuminate\Support\Facades\Http;

class SeoAnalyzerServices
{
    protected $serpApisKey;



    public function __construct()
    {
        $this->serpApisKey = env('SERPAPI_KEY');

    }

    // Fetch blog rank from google

    public function getGoogleRank($keyword, $targetUrl)
    {
        $response = Http::get('https://serpapi.com/search', [
            'engine' => 'google',
            'q' => $keyword,
            'api_key' => $this->serpApisKey,
        ]);

        // Get results in json

        $results = $response->json();


        if(!isset($results['organic_results']))  return null;


        foreach ($results['organic_results'] as $index => $result) {
            if (isset($result['link']) && str_contains($result['link'], $targetUrl)) {
                return $index + 1; // Rank is 1-based
            }
        }

        return null;
    }

}