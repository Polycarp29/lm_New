<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\JoinUs;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JoinUsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JoinUsResource\RelationManagers;

class JoinUsResource extends Resource
{
    protected static ?string $model = JoinUs::class;

    protected static ?string $navigationIcon = 'heroicon-o-window';

    protected static ? string $navigationGroup = 'Join Us Widget';

    protected static ? string $navigationLabel = 'Main Widget';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('header')->required()
                ->label('Widget Header'),
                RichEditor::make('description')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('header')->sortable()->searchable(),
                TextColumn::make('description')->sortable()->searchable(),
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
            'index' => Pages\ListJoinUs::route('/'),
            'create' => Pages\CreateJoinUs::route('/create'),
            'edit' => Pages\EditJoinUs::route('/{record}/edit'),
        ];
    }
}
