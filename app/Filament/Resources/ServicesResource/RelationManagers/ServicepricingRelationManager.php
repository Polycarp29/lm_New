<?php

namespace App\Filament\Resources\ServicesResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ServicepricingRelationManager extends RelationManager
{
    protected static string $relationship = 'servicepricing';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('services_id')->relationship('services', 'service_header')->required()->label('Service Name'),
                TextInput::make('price')->numeric()->label('Price')->required(),
                Toggle::make('isActie')->required()->label('is Active'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ServicePricing')
            ->columns([
                TextColumn::make('price')->badge()->color('primary')->sortable()-> searchable(),
                ToggleColumn::make('isActie'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
