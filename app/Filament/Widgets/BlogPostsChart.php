<?php

namespace App\Filament\Widgets;

use App\Models\Task\TaskAllocation;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Blogs Posts Done';

    protected static ?int $sort = 3;



    protected function getData(): array
    {
        $trendData = Trend::model(TaskAllocation::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        // Initialize months with 0
        $months = [
            'Jan' => 0, 'Feb' => 0, 'Mar' => 0, 'Apr' => 0,
            'May' => 0, 'Jun' => 0, 'Jul' => 0, 'Aug' => 0,
            'Sep' => 0, 'Oct' => 0, 'Nov' => 0, 'Dec' => 0,
        ];

        // Fill months from actual data
        foreach ($trendData as $item) {
            $monthName = \Carbon\Carbon::parse($item->date)->format('M'); // Get 'Jan', 'Feb', etc.
            $months[$monthName] = $item->aggregate; // Set count
        }

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => array_values($months),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => array_keys($months),
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}

