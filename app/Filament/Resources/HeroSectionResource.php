<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\HeroSection;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HeroSectionResource\Pages;
use App\Filament\Resources\HeroSectionResource\RelationManagers;

class HeroSectionResource extends Resource
{
    protected static ?string $model = HeroSection::class;

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

    protected static ? string $navigationGroup = 'Home Page Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Edit Hero Section')->schema(
                    [
                        FileUpload::make('hero_image')->image()->directory('images/herosection'),
                        TextInput::make('l_smallheader')->label('Top Header')->required(),
                        TextInput::make('header')->label('Main Header')->required(),
                        RichEditor::make('description')->required()->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ]),
                        Toggle::make('isVisible')  ->onIcon('heroicon-m-eye')
                        ->offIcon('heroicon-m-eye-slash'),
                    ]

                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('hero_image')
                    ->url(fn($record) => asset('storage/' . $record->hero_image))
                    ->defaultImageUrl(url('/images/herosection/default.png'))
                    ->label('Hero Image'),
                TextColumn::make('l_smallheader')->sortable()->label('Top Small Header'),
                TextColumn::make('header')->sortable()->label('Main Header'),

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
            'index' => Pages\ListHeroSections::route('/'),
            'create' => Pages\CreateHeroSection::route('/create'),
            'edit' => Pages\EditHeroSection::route('/{record}/edit'),
        ];
    }
}
