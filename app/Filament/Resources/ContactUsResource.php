<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Contact_Us;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Split;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ContactUsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContactUsResource\RelationManagers;

class ContactUsResource extends Resource
{
    protected static ?string $model = Contact_Us::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationGroup = "Form responses";

    protected static ?string $navigationLabel = 'Contact Form';

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
                    TextColumn::make('name')
                        ->weight(FontWeight::Bold)
                        ->searchable()
                        ->sortable(),
                    TextColumn::make('surname'),

                    TextColumn::make('email')
                        ->description(fn(Contact_Us $contact) => $contact->message),
                ])
            ])
            ->filters([
                //
            ])
            ->actions([
                // View Message
                Action::make('delete')
                    ->requiresConfirmation()
                    ->icon('heroicon-m-x-circle')
                    ->button()
                    ->color('danger')
                    ->action(fn(Contact_Us $record) => $record->delete()),
                // Delete Message
                Action::make('view')
                ->icon('heroicon-m-eye')
                    ->button()
                    ->color('success'),
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
            'index' => Pages\ListContactUs::route('/'),
            'create' => Pages\CreateContactUs::route('/create'),
            'edit' => Pages\EditContactUs::route('/{record}/edit'),
        ];
    }
}
