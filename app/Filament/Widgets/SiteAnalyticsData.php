<?php

namespace App\Filament\Widgets;

use App\Services\GoogleAnalyticsService;
use Filament\Widgets\ChartWidget;

class SiteAnalyticsData extends ChartWidget
{
    protected static ?string $heading = 'Site Analytics Chart';

    protected static ?int $sort = 2;

    protected function getData(): array

    {

        $analyticsService = new GoogleAnalyticsService();

        // Replace with your GA4 Property ID
        $propertyId = '475506584';

        // Fetch data from the Google Analytics Service
        $data = $analyticsService->getAnalyticsData($propertyId);

        // Initialize labels and dataset arrays
        $labels = []; // For chart labels (e.g., dates, countries, etc.)
        $values = []; // For chart values (e.g., active users)

        // Process the rows from the response
        foreach ($data->getRows() as $row) {
            $labels[] = $row['dimensionValues'][0]['value']; // Example: Country or Date
            $values[] = $row['metricValues'][0]['value'];    // Example: Active Users
        }


        return [
            //
            'datasets' => [
                [
                    'label' => 'Active Users',
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
