<?php

namespace App\Providers;

use App\Models\Miscs;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\QuoteResource\Pages\ViewQuote;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Pass Favicon and Meta Description Data
        View::composer('components.layouts.app', function ($view) {
            $settings = Miscs::first(); // Adjust for your table
            $view->with([
                'title' => $settings->brand_name ?? '',
                'metaDescription' => $settings->meta_description ?? 'Default Meta Description',
                'favicon' => $settings->favicon ?? 'default-favicon.ico',
            ]);
        });

        Route::get('/quotes/{quote}', ViewQuote::class)->name('quotes.view');
    }
}
