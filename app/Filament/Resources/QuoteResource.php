<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Quote;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Split;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuoteResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuoteResource\RelationManagers;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = "Product Services";

    protected static ?string $navigationLabel = 'View Quote';




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Split::make([
                    TextColumn::make('fname')
                        ->weight(FontWeight::Bold)
                        ->searchable()
                        ->sortable()
                        ->description('Client first name'),
                    TextColumn::make('lname')->description('Client surname name'),

                    TextColumn::make('phone_number')->description('Client Request Phone Number'),

                    TextColumn::make('service_id')
                        ->label('Service Name')  // Optional: Set a custom label for the column
                        ->sortable()
                        ->searchable()
                        ->getStateUsing(function ($record) {
                            // Assuming 'service_id' is the foreign key for the 'service' model
                            return $record->service ? $record->service->service_header : 'No Service';  // Access the related service's 'name' field
                        }),



                    TextColumn::make('email')
                        ->description(fn(Quote $contact) => $contact->message),
                ])
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->icon('heroicon-m-x-circle')
                    ->button()
                    ->color('danger')
                    ->action(fn(Quote $record) => $record->delete()),
                // Delete Message
                Action::make('view')
                    ->icon('heroicon-m-eye')
                    ->button()
                    ->color('success')
                    ->action(fn(Quote $record) => redirect()->route('quotes.view', $record))
                //Action For View
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
            'index' => Pages\ListQuotes::route('/'),
            // 'create' => Pages\CreateQuote::route('/create'),
            // 'edit' => Pages\EditQuote::route('/{record}/edit'),
            'view' => Pages\ViewQuote::route('/view'),
        ];
    }
}
