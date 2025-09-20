<?php

namespace App\Filament\Resources\ClientsTestimonailVideosResource\Pages;

use App\Filament\Resources\ClientsTestimonailVideosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientsTestimonailVideos extends EditRecord
{
    protected static string $resource = ClientsTestimonailVideosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
