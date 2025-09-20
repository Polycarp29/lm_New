<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Storage;
use App\Models\ClientsTestimonailVidoes;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClientsTestimonailVideosResource\Pages;
use App\Filament\Resources\ClientsTestimonailVideosResource\RelationManagers;

class ClientsTestimonailVideosResource extends Resource
{
    protected static ?string $model = ClientsTestimonailVidoes::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = 'Join Us Widget';

    protected static ? string $navigationLabel = 'Client Videos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('title')->required(),
                FileUpload::make('attachment')
                    ->disk('public') // Ensure the correct disk is used
                    ->directory('uploads/attachments') // Specify a subdirectory
                    ->acceptedFileTypes(['video/mp4', 'image/jpeg', 'image/png', 'application/pdf'])
                    ->maxSize(51200) // Limit in KB (e.g., 50MB)
                    ->visibility('public'), // Make the file publicly accessible

            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('attachment')
                    ->url(fn ($record) => Storage::url($record->video_path))
                    ->label('Video'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientsTestimonailVideos::route('/'),
            'create' => Pages\CreateClientsTestimonailVideos::route('/create'),
            'edit' => Pages\EditClientsTestimonailVideos::route('/{record}/edit'),
        ];
    }
}
