<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AccountDetails;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AccountDetailsResource\Pages;
use App\Filament\Resources\AccountDetailsResource\RelationManagers;

class AccountDetailsResource extends Resource
{
    protected static ?string $model = AccountDetails::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';


    protected static ?string $navigationGroup = "Account Management";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Account Details')
                    ->description('Ensure you fill in the correct account details')
                    ->aside()
                    ->schema(
                        [
                            TextInput::make('account_name')->required()->label('Account Name'),
                            Select::make('user_id')->relationship(
                                'user', 'name'
                            )->required()->label('Account Holder Username'),
                            Select::make('methods')
                                ->label('Payment Methods')
                                ->options([
                                    'Mpesa' => 'Mpesa',
                                    'Bank' => 'Bank',
                                    'Paypal' => 'Paypal',
                                    'Cash' => 'Cash',
                                ])
                                ->reactive() // Enables listening to changes
                                ->afterStateUpdated(fn(callable $set, $state) => $set('paymentDetails', null)),

                            // Mpesa Field
                            TextInput::make('mpesa_number')
                                ->label('Mpesa Number')
                                ->visible(fn(callable $get) => $get('methods') === 'Mpesa') // Show only for Mpesa
                                ->required(fn(callable $get) => $get('methods') === 'Mpesa'),

                            // Bank Details Field
                            TextInput::make('bank_account')
                                ->label('Bank Account')
                                ->visible(fn(callable $get) => $get('methods') === 'Bank') // Show only for Bank
                                ->required(fn(callable $get) => $get('methods') === 'Bank'),

                            // PayPal Email Field
                            TextInput::make('paypal_email')
                                ->label('PayPal Email')
                                ->email()
                                ->visible(fn(callable $get) => $get('methods') === 'Paypal') // Show only for Paypal
                                ->required(fn(callable $get) => $get('methods') === 'Paypal'),

                            TextInput::make('bank_name')
                            ->label('Bank Name')
                            ->visible( fn(callable $get) => $get('methods') === 'Bank')
                            ->required(fn(callable $get) => $get('methods') === 'Bank'),


                        ]
                    )->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('account_name')
                ->searchable()
                ->sortable()
                ->label('Account Name'),

                TextColumn::make('methods')->searchable()->sortable()->label('Payment Method')

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
            'index' => Pages\ListAccountDetails::route('/'),
            'create' => Pages\CreateAccountDetails::route('/create'),
            'edit' => Pages\EditAccountDetails::route('/{record}/edit'),
        ];
    }
}
