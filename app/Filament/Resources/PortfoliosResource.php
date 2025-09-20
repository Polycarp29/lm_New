<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Portfolio;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PortfoliosResource\Pages;
use App\Filament\Resources\PortfoliosResource\RelationManagers;

class PortfoliosResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ? string $navigationGroup = 'Home Page Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Portfolio Descrition')->schema([
                    TextInput::make('header')->required(),
                    RichEditor::make('description')->required(),
                    FileUpload::make('icon')->image()->directory('/images/portfolio')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('icon')
                    ->url(fn($record) => asset('storage/' . $record->hero_image))
                    ->defaultImageUrl(url('/images/herosection/default.png'))
                    ->label('Icon Image'),
                    TextColumn::make('header')
                        ->description(fn (Portfolio $record): string => strip_tags($record->description), position: 'below')
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolios::route('/create'),
            'edit' => Pages\EditPortfolios::route('/{record}/edit'),
        ];
    }
}
