<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\UpperAboutSection;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UpperAboutSectionResource\Pages;
use App\Filament\Resources\UpperAboutSectionResource\RelationManagers;

class UpperAboutSectionResource extends Resource
{
    protected static ?string $model = UpperAboutSection::class;

    protected static ?string $navigationGroup = "About Us Page";

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Upper Section')
                    ->description('Set what to appear on the upper part of about Us page')
                    ->aside()
                    ->schema([
                        TextInput::make('top_header')->required(),
                        TextInput::make('first_container_title')->required(),
                        RichEditor::make('first_container_desc')->required(),

                    ]),

                Section::make('Second Container')
                    ->description('Set what to appear on second container about Us page')
                    ->aside()
                    ->schema([
                        TextInput::make('second_container_title')->required(),
                        RichEditor::make('second_container_dec')->required(),

                    ]),

                Section::make('Our Story')
                    ->description('Set Our Story widget')
                    ->aside()
                    ->schema([
                        FileUpload::make('right_image')
                        ->image()
                        ->directory('images/AboutUs')
                        ->label('Item Icon'),
                        TextInput::make('left_header')->required(),
                        RichEditor::make('left_description')->required(),


                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Define columns for the table display
                TextColumn::make('top_header')
                    ->label('Top Header')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('right_image')
                    ->url(fn($record) => asset('storage/' . $record->hero_image))
                    ->defaultImageUrl(url('/images/herosection/default.png'))
                    ->label('Right Image'),

                TextColumn::make('left_header')
                    ->label('Left Header')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('left_description')
                    ->label('Left Description')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListUpperAboutSections::route('/'),
            'create' => Pages\CreateUpperAboutSection::route('/create'),
            'edit' => Pages\EditUpperAboutSection::route('/{record}/edit'),
        ];
    }
}
