<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\RequestAnalysis;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RequestAnalysisResource\Pages;
use App\Filament\Resources\RequestAnalysisResource\RelationManagers;

class RequestAnalysisResource extends Resource
{
    protected static ?string $model = RequestAnalysis::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationGroup = "Form responses";

    protected static ? string $navigationLabel = 'Requested Analysis';


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
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->description(fn(RequestAnalysis $analysis) => "{$analysis->address} | {$analysis->email}"),

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('approve')
                    ->requiresConfirmation()
                    ->icon('heroicon-m-check-circle')
                    ->button()
                    ->color('success'),
                  // Action For Approve
                Action::make('reject')
                    ->requiresConfirmation()
                    ->icon('heroicon-m-x-circle')
                    ->button()
                    ->color('danger')
                    ->action(fn(RequestAnalysis $record) => $record->delete())

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
            'index' => Pages\ListRequestAnalyses::route('/'),
            // 'create' => Pages\CreateRequestAnalysis::route('/create'),
            // 'edit' => Pages\EditRequestAnalysis::route('/{record}/edit'),
        ];
    }
}
