<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AboutUsConfig;
use App\Models\RightAboutUsImg;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RightAboutUsImgResource\Pages;
use App\Filament\Resources\RightAboutUsImgResource\RelationManagers;

class RightAboutUsImgResource extends Resource
{
    protected static ?string $model = RightAboutUsImg::class;

    protected static ?string $navigationIcon = 'heroicon-s-photo';

    protected static ? string $navigationGroup = 'Home Page Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Details')->schema([
                    FileUpload::make('right_image')
                        ->image()
                        ->directory('images/homeAboutUs')
                        ->label('Item Icon'),
                    TextInput::make('alt')->label('Alt Image'),
                    Select::make('about_us_config_id')
                        ->options(AboutUsConfig::pluck('id', 'id')) // Fetch IDs from AboutUsConfig
                        ->searchable()
                        ->required()
                        ->default(8)
                        ->label('Conf ID'),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('right_image')
                ->url(fn($record) => asset('storage/' . $record->right_image))
                ->defaultImageUrl(url('/images/herosection/default.png'))
                ->label('Right Image'),
                TextColumn::make('alt')->sortable()->label('Alt Image'),

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
            'index' => Pages\ListRightAboutUsImgs::route('/'),
            'create' => Pages\CreateRightAboutUsImg::route('/create'),
            'edit' => Pages\EditRightAboutUsImg::route('/{record}/edit'),
        ];
    }
}
