<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Quote;
use App\Models\RequestAnalysis;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\RequestAnalysis;
use App\Models\Quote;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $analysisRequests = RequestAnalysis::count();
        $quoteRequests = Quote::count();

        return [
            Stat::make('Total Users', $totalUsers)
                ->description('Total Number of Users/ Employees in the company')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color($totalUsers > 100 ? 'success' : 'warning'), // Change color based on the user count

            Stat::make('Site Analysis Requests', $analysisRequests)
                ->description('Site Analysis Requests per page visit')
                ->descriptionIcon('heroicon-m-chart-pie')
                ->color($analysisRequests > 50 ? 'success' : ($analysisRequests > 20 ? 'warning' : 'danger')), // Dynamic color based on request count

            Stat::make('Quote Requests', $quoteRequests)
                ->description('Number of Quote Requests submitted')
                ->descriptionIcon('heroicon-m-document')
                ->color($quoteRequests > 30 ? 'success' : 'danger'),
        ];
    }
}

