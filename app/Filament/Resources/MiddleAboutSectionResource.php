<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\MiddleAboutSection;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MiddleAboutSectionResource\Pages;
use App\Filament\Resources\MiddleAboutSectionResource\RelationManagers;

class MiddleAboutSectionResource extends Resource
{
    protected static ?string $model = MiddleAboutSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup ="About Us Page";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Set Analytics')
                ->description('Set client and company analytics data')
                ->aside()
                ->schema([
                    TextInput::make('icon')->required()->label('SVG Path')->hint('Must be an heroicon path'),
                    TextInput::make('title_data')->required(),
                    TextInput::make('analytics')->required(),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('title_data')->description('Title Description for the data to be displayed')->sortable()->searchable()
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
            'index' => Pages\ListMiddleAboutSections::route('/'),
            'create' => Pages\CreateMiddleAboutSection::route('/create'),
            'edit' => Pages\EditMiddleAboutSection::route('/{record}/edit'),
        ];
    }
}
