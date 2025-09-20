<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Tags;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TagsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TagsResource\RelationManagers;

class TagsResource extends Resource
{
    protected static ?string $model = Tags::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ? string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Tags')->schema([
                    TextInput::make('name')->live()->required()->maxLength(150)->afterStateUpdated(function( $operation, $state, Forms\set $set){
                        $set('slug', Str::slug($state));
                    }),

                    TextInput::make('slug')->required()->unique(ignoreRecord:true)->maxLength(150),

                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')->sortable(),
                TextColumn::make('slug')->sortable(),
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
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTags::route('/create'),
            'edit' => Pages\EditTags::route('/{record}/edit'),
        ];
    }
}
