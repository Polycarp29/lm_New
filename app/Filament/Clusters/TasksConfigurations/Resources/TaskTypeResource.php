<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\TaskType;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\TasksConfigurations;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\TasksConfigurations\Resources\TaskTypeResource\Pages;
use App\Filament\Clusters\TasksConfigurations\Resources\TaskTypeResource\RelationManagers;

class TaskTypeResource extends Resource
{
    protected static ?string $model = TaskType::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-center-left';

    protected static ?string $navigationLabel = 'Task Type';

    protected static ?string $cluster = TasksConfigurations::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make()->schema([
                    TextInput::make('type_name')->label('Task Type')->required(),
                    Select::make('task_insurer_id')->relationship('taskinsurer', 'issuer_name')->label('Task Owner')->searchable()->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('type_name')->label('Task Type')->sortable()->searchable(),
                TextColumn::make('taskinsurer.issuer_name')->label('Task Owner')->sortable()->searchable(),
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
            'index' => Pages\ListTaskTypes::route('/'),
            'create' => Pages\CreateTaskType::route('/create'),
            'edit' => Pages\EditTaskType::route('/{record}/edit'),
        ];
    }
}
