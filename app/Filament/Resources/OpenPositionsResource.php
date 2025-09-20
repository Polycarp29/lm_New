<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\OpenPositions;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OpenPositionsResource\Pages;
use App\Filament\Resources\OpenPositionsResource\RelationManagers;
use App\Filament\Resources\OpenPositionsResource\RelationManagers\JobopeningadataRelationManager;

class OpenPositionsResource extends Resource
{
    protected static ?string $model = OpenPositions::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ? string $navigationGroup = 'Join Us Widget';

    protected static ? string $navigationLabel = 'Open Job Section';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Create a job alert Entry')
                ->description('Fill in the job details that will appear on the join us page')
                ->schema([
                    Card::make('Job Form Card')
                    ->schema([
                        Select::make('joinus_id')
                        ->relationship('joinus', 'header')->label('Belongs To')->required(),
                        TextInput::make('job-title')->required(),
                        Select::make('type')->
                        options([
                            'full-time' => 'FullTime',
                            'remote' => 'Remote',
                            'part-time' => 'Part Time',
                        ])->
                        required(),
                        RichEditor::make('job_description')->required(),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('job-title')->searchable()->sortable(),
                TextColumn::make('type')->searchable()->sortable(),

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
            JobopeningadataRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOpenPositions::route('/'),
            'create' => Pages\CreateOpenPositions::route('/create'),
            'edit' => Pages\EditOpenPositions::route('/{record}/edit'),
        ];
    }
}
