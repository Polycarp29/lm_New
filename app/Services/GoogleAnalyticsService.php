<?php

namespace App\Services;

use Google\Client;
use Google\Service\AnalyticsData;


class GoogleAnalyticsService
{
    private $analytics;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google-analytics/leemarketing-e5f813bb50b1.json'));
        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');
        $this->analytics = new AnalyticsData($client);

    }

    public function getAnalyticsData($propertyId, $startDate = '30daysAgo', $endDate = 'today')
    {
        $request = new \Google\Service\AnalyticsData\RunReportRequest([
            'dimensions' => [new \Google\Service\AnalyticsData\Dimension(['name' => 'country'])],
            'metrics' => [new \Google\Service\AnalyticsData\Metric(['name' => 'activeUsers'])],
            'dateRanges' => [
                new \Google\Service\AnalyticsData\DateRange(['startDate' => $startDate, 'endDate' => $endDate]),
            ],
        ]);

        return $this->analytics->properties->runReport("properties/$propertyId", $request);
    }
}
