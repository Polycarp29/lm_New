<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Models\Quote;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\QuoteResource;

class ViewQuote extends Page
{
    protected static string $resource = QuoteResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-view';

    protected static string $view = 'filament.resources.quote-resource.pages.view-quote';

    public $quote;

    public function mount(Quote $quote)
    {
        $this->quote = $quote;
    }
}
