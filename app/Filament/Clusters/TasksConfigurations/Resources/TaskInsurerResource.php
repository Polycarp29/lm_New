<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TaskInsurer;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\TasksConfigurations;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\TasksConfigurations\Resources\TaskInsurerResource\Pages;
use App\Filament\Clusters\TasksConfigurations\Resources\TaskInsurerResource\RelationManagers;

class TaskInsurerResource extends Resource
{
    protected static ?string $model = TaskInsurer::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static ? string $navigationLabel = 'Task Owners';

    protected static ?string $cluster = TasksConfigurations::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make()->schema([
                    TextInput::make('issuer_name')->label('TaskOwner name'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('issuer_name')->label('TaskOwner name')->searchable()->sortable()
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
            'index' => Pages\ListTaskInsurers::route('/'),
            'create' => Pages\CreateTaskInsurer::route('/create'),
            'edit' => Pages\EditTaskInsurer::route('/{record}/edit'),
        ];
    }
}
