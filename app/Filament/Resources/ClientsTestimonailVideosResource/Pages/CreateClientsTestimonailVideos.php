<?php

namespace App\Filament\Resources\ClientsTestimonailVideosResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ClientsTestimonailVideosResource;

class CreateClientsTestimonailVideos extends CreateRecord
{
    protected static string $resource = ClientsTestimonailVideosResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = Storage::disk('public')->mimeType($data['attachment']);

        return $data;
    }
}
