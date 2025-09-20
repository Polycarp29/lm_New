<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Services;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ServicesResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ServicesResource\RelationManagers;
use App\Filament\Resources\ServicesResource\RelationManagers\ServicepricingRelationManager;

class ServicesResource extends Resource
{
    protected static ?string $model = Services::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ? string $navigationGroup = "Product Services";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Our Services')
                ->description('Add widget to display the services your company offers')
                ->aside()
                ->schema([
                    TextInput::make('service_header')->required(),
                    RichEditor::make('description')->required(),
                    FileUpload::make('icon')
                    ->image()
                    ->disk('public')
                    ->directory('services/icons')
                    ->label('Icon')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('service_header')->description(fn(Services $service) =>  strip_tags(Str::limit($service->description, 100))),
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
            ServicepricingRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateServices::route('/create'),
            'edit' => Pages\EditServices::route('/{record}/edit'),
        ];
    }
}
