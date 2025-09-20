<?php

namespace App\Filament\Clusters\TasksConfigurations\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use App\Models\Task\LeeMarketingSOP;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Clusters\TasksConfigurations;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\TasksConfigurations\Resources\LeeMarketingSOPResource\Pages;
use App\Filament\Clusters\TasksConfigurations\Resources\LeeMarketingSOPResource\RelationManagers;

class LeeMarketingSOPResource extends Resource
{
    protected static ?string $model = LeeMarketingSOP::class;

    protected static ?string $navigationIcon = 'heroicon-o-cloud-arrow-down';

    protected static? string $label = 'Lee Marketing SOP';

    protected static ?string $cluster = TasksConfigurations::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Update Lee Marketing SOP')->description('Fill in the entries to update the Article SOP that will displayed in every user dashboard')
                ->schema(
                    [
                        TextInput::make('title')->label('Title'),
                        RichEditor::make('sop_content')->label('SOP CONTENT')->required(),
                        Toggle::make('is_active')->label('Mark Active')->required(),
                        Select::make('task_insurers_id')->label('Client Name')
                        ->relationship('taskInsurers', 'issuer_name')
                        ->required(),
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('sop_content')->label('SOP Content')->formatStateUsing(fn($state) => strip_tags($state))->limit(200)->wrap(),
                BooleanColumn::make('is_active')->label('Is Marked Active?'),
                TextColumn::make('taskInsurers.issuer_name')->label('Sheet Client')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('view')->label('View Document')->color('success')->icon('heroicon-o-eye')
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
            'index' => Pages\ListLeeMarketingSOPS::route('/'),
            'create' => Pages\CreateLeeMarketingSOP::route('/create'),
            'edit' => Pages\EditLeeMarketingSOP::route('/{record}/edit'),
        ];
    }
}
