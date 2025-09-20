<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use App\Models\Task\TaskAllocation;
use Filament\Widgets\BarChartWidget;

class WriterLeaderBoard extends BarChartWidget
{
    protected static ?string $heading = 'Writers Leader Board';



    protected static ? int $sort = 5;


    protected function getColumns(): int
    {
        return 1;
    }

    public function getColumnSpan(): string|int|array
    {
        return 'full';
    }

    protected function getData(): array
    {
        $users = User::all();

        $labels = [];
        $data = [];

        foreach ($users as $user) {
            $avg = TaskAllocation::where('writer_id', $user->id)
                ->avg('perfomance_score');

            $labels[] = $user->name;
            $data[] = round($avg, 2); // rounded for display
        }

        return [
            'datasets' => [
                [
                    'label' => 'Average Performance Score',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
