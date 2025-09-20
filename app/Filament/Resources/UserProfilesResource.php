<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\UserProfiles;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserProfilesResource\Pages;
use App\Filament\Resources\UserProfilesResource\RelationManagers;

class UserProfilesResource extends Resource
{
    protected static ?string $model = UserProfiles::class;

    protected static ?string $navigationGroup = "Account Management";

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Addition  User Profile Details')
                ->description('Complete User profile details in the system')
                ->aside()
                ->schema([
                    TextInput::make('fname')->required()->label('First Name'),
                    TextInput::make('lname')->required()->label('Last Name'),
                    Select::make('user_id')
                    ->relationship('user', 'name')->required()
                    ->label('Username')->searchable(),
                    TextInput::make('id_number')->required(),
                    RichEditor::make('bio')->label('User Bio'),
                    TextInput::make('phone_number')->required(),
                    FileUpload::make('avatar')
                    ->image()
                    ->directory('/image/avatars/employees')
                    ->label('Avatar')
                    ->required()

                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                ImageColumn::make('avatar')->url(fn($record) => asset('storage/' . $record->avatar)),

                TextColumn::make('fname')->searchable()->sortable()->label('First Name'),

                TextColumn::make('lname')->searchable()->sortable()->label('Last Name'),
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
            'index' => Pages\ListUserProfiles::route('/'),
            'create' => Pages\CreateUserProfiles::route('/create'),
            'edit' => Pages\EditUserProfiles::route('/{record}/edit'),
        ];
    }
}
