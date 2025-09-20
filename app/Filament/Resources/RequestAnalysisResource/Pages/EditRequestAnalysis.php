<?php

namespace App\Filament\Resources\RequestAnalysisResource\Pages;

use App\Filament\Resources\RequestAnalysisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestAnalysis extends EditRecord
{
    protected static string $resource = RequestAnalysisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
