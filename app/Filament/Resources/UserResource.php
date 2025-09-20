<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static ? string $navigationGroup = "Account Management";



    // Filters User Columns based on Permissions
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereDoesntHave('roles', function (Builder $query) {
            $query->where('name', 'super_admin');
        });
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Basic Details')
                    ->description('Basic User Details Like Email, Password and User Name')
                    ->schema([
                        TextInput::make('name')
                            ->label('Username')
                            ->unique(ignoreRecord: true)
                            ->rules([
                                'required',
                                'max:11',

                            ]),
                        TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter your email')
                            ->helperText('Please provide a valid email address.'),

                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->minLength(8)
                            ->maxLength(64)
                            ->revealable()
                            ->placeholder('Enter your password')
                            ->helperText('Password must be at least 8 characters long.')
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (Page $livewire) => ($livewire instanceof CreateUser)),

                            // Include Roles
                            Select::make('Role')
                            ->multiple()
                            ->preload()
                            ->relationship('roles', 'name', function ($query) {
                                // Filter the roles based on the authenticated user's role
                                if (auth()->user()->hasRole('super_admin')) {
                                    return $query; // No restrictions for super_admin
                                }

                                // Restrict other roles from seeing or assigning super_admin
                                return $query->where('name', '!=', 'super_admin');
                            })
                            ->label('Set Role')
                            ->visible(fn () => auth()->user()->hasRole('super_admin') || auth()->user()->can('assign roles')),

                        // INclude Permissions

                        Select::make('Permissions')
                            ->multiple()
                            ->preload()
                            ->relationship('permissions', 'name')
                            ->label('Set Permission')

                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
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
            RelationManagers\PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


}
