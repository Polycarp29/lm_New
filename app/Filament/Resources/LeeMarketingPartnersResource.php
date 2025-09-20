<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\LeeMarketingPartners;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LeeMarketingPartnersResource\Pages;
use App\Filament\Resources\LeeMarketingPartnersResource\RelationManagers;

class LeeMarketingPartnersResource extends Resource
{
    protected static ?string $model = LeeMarketingPartners::class;

    public static ? string $navigationGroup = 'Join Us Widget';

    protected static ?string $navigationIcon = 'heroicon-o-hand-thumb-up';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('partner_name')->label('Name of the Partner')->required(),
                FileUpload::make('partner_logo')
                ->image()
                ->disk('public')
                ->directory('uploads/partner_logos')
                ->required(),
                Toggle::make('isActive')->label('Active')->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('partner_logo')
                ->url(fn($record) => asset('storage/' . $record->partner_logo))
                ->defaultImageUrl(url('/images/herosection/default.png'))
                ->label('Partner Logo'),
                TextColumn::make('partner_name')->label('Partner Name')->searchable()->sortable()
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
            'index' => Pages\ListLeeMarketingPartners::route('/'),
            'create' => Pages\CreateLeeMarketingPartners::route('/create'),
            'edit' => Pages\EditLeeMarketingPartners::route('/{record}/edit'),
        ];
    }
}
