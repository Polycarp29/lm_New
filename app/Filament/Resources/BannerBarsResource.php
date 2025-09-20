<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\BannerBars;
use Filament\Tables\Table;
use App\Models\AboutUsBanner;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BannerBarsResource\Pages;
use App\Filament\Resources\BannerBarsResource\RelationManagers;

class BannerBarsResource extends Resource
{
    protected static ?string $model = BannerBars::class;

    protected static ?string $navigationIcon = 'heroicon-s-battery-100';

    protected static ? string $navigationGroup = 'Home Page Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Section::make('Set Home Progress Bars')->schema([
                    Select::make('about_us_banner_id')
                    ->options(AboutUsBanner::all()->pluck('header', 'id'))
                    ->searchable()
                    ->required()
                    ->label('Conf ID'),
                    TextInput::make('bar_string')->required()->label('Css Class'),
                    TextInput::make('bar_description')->required()->label('Bar Title'),
                    TextInput::make('percentage')->required()->label('Progress %'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('bar_string')->sortable()->label('Css Class'),
                TextColumn::make('bar_description')->sortable()->label('Bar Header'),
                TextColumn::make('percentage')->sortable()->label('Progess (%)')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->visible(fn ($record) => auth()->user()?->can('delete_widgets')),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()

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
            'index' => Pages\ListBannerBars::route('/'),
            'create' => Pages\CreateBannerBars::route('/create'),
            'edit' => Pages\EditBannerBars::route('/{record}/edit'),
        ];
    }
}
