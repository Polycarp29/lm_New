<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\RegisterCompany;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RegisterCompanyResource\Pages;
use Parfaitementweb\FilamentCountryField\Forms\Components\Country;
use App\Filament\Resources\RegisterCompanyResource\RelationManagers;

class RegisterCompanyResource extends Resource
{
    protected static ?string $model = RegisterCompany::class;

    protected static ? string $navigationGroup = 'Miscs';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Register Your Company')
                ->description('Register company details that will appear in the systems contacts and invoices')
                ->aside()
                ->schema([
                    TextInput::make('company_name')->required()->label('Company Name'),
                    TextInput::make('city')->required()->label('City'),
                    TextInput::make('postal_code')->required()->label('Postal Code'),
                    TextInput::make('state')->required()->label('State'),
                    Country::make('country')->required()->label('Country'),
                    TextInput::make('email')->required()->label('Email'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('company_name')->label('Company Name'),
                TextColumn::make('city')->label('City'),
                TextColumn::make('postal_code')->label('Postal Code'),
                TextColumn::make('state')->label('State')
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
            'index' => Pages\ListRegisterCompanies::route('/'),
            'create' => Pages\CreateRegisterCompany::route('/create'),
            'edit' => Pages\EditRegisterCompany::route('/{record}/edit'),
        ];
    }
}
