<?php

namespace App\Filament\Resources\OpenPositionsResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class JobopeningadataRelationManager extends RelationManager
{
    protected static string $relationship = 'jobopeningadata';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fname')->required()->label('First Name'),
                TextInput::make('lname')->required()->label('Last Name'),
                TextInput::make('mname')->required()->label('Middle Name'),
                TextInput::make('email')->required()->label('Email')->email(),
                TextInput::make('phone_number')->required()->label('Phone Number'),
                FileUpload::make('cv')
                    ->imagePreviewHeight('250')
                    ->loadingIndicatorPosition('left')
                    ->panelAspectRatio('2:1')
                    ->panelLayout('integrated')
                    ->removeUploadedFileButtonPosition('right')
                    ->uploadButtonPosition('left')
                    ->uploadProgressIndicatorPosition('left'),
                Select::make('open_positions_id')->relationship(
                    'openposition',
                    'job-title',
                )->required()->searchable(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('JobOpeningData')
            ->columns([
                TextColumn::make('fname')->sortable()->searchable()->label('First Name'),
                TextColumn::make('lname')->searchable()->sortable()->label('Last Name'),
                TextColumn::make('mname')->searchable()->sortable()->label('Middle Name'),
                TextColumn::make('email')->searchable()->sortable()->label('Email'),
                TextColumn::make('phone_number')->searchable()->sortable()->label('Phone Number'),
                BadgeColumn::make('cv')
                    ->label('Cv Directory')
                    ->url(fn($record) => asset('storage/' . $record->cv))
                    ->openUrlInNewTab(),


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
