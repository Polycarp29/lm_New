<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Task\TasksCategories;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\SheetHasBeenCreated;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Support\Facades\Notification;
use App\Filament\Clusters\TasksConfigurations;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\TasksConfigurations\Resources\TaskCategoriesResource\Pages;
use App\Filament\Clusters\TasksConfigurations\Resources\TaskCategoriesResource\RelationManagers;
use App\Filament\Clusters\TasksConfigurations\Resources\TaskCategoriesResource\RelationManagers\TaskallocationRelationManager;

class TaskCategoriesResource extends Resource
{
    protected static ?string $model = TasksCategories::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-2';

    protected static ?string $cluster = TasksConfigurations::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Sheet Name(Contains Task Articles)')->description('This section allows you to set a specific task category for a specific task: All tasks will be under this category')
                    ->schema([
                        TextInput::make('task_name')->label('Sheet Name')->required(),
                        RichEditor::make('task_description')->label('Task Description')->required(),
                        DatePicker::make('date_month')->label('Date & Month')->required(),
                        Select::make('task_type_id')
                            ->relationship('tasktypes', 'type_name')
                            ->getOptionLabelFromRecordUsing(

                                fn($record) =>
                                "{$record->type_name} - " .
                                    $record->taskinsurer->pluck('issuer_name')->join(', ')
                            )->label('Task Type & Company')
                            ->searchable()
                            ->required(),
                        Toggle::make('isActive')->required()->label('Activate Sheet'),

                    ])->columns(2)
                            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('task_name')
                    ->label('Sheet Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('task_description')
                    ->label('Sheet Description')
                    ->limit(100)
                    ->formatStateUsing( fn($state) =>strip_tags($state))
                    ->description( fn(TasksCategories $tasks) => strip_tags($tasks->description))
                    ->wrap(),

                TextColumn::make('date_month')
                    ->color('primary')
                    ->since()
                    ->dateTimeTooltip()
                    ->label('Date'),

                TextColumn::make('tasktypes.type_name')
                    ->label('Task Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tasktypes.taskinsurer.issuer_name')
                    ->label('Insurer')
                    ->sortable()
                    ->searchable(),

                IconColumn::make('isActive')
                    ->label('Active')
                    ->boolean(),
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

            TaskallocationRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskCategories::route('/'),
            'create' => Pages\CreateTaskCategories::route('/create'),
            'edit' => Pages\EditTaskCategories::route('/{record}/edit'),
        ];
    }
}
