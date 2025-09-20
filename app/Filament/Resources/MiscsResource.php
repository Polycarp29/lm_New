<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Miscs;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use App\Filament\Resources\MiscsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MiscsResource\RelationManagers;

class MiscsResource extends Resource
{
    protected static ?string $model = Miscs::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ? string $navigationGroup = 'Miscs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Brand Logo')
                ->description('Dynamically Set Your Company Brand Logo')
                ->aside()
                ->schema([
                    FileUpload::make('logo')
                        ->image()
                        ->directory('/images/mics/logo')
                        ->label('Your Brand Logo'),
                    TextInput::make('size')
                        ->numeric() // Ensures only numeric values can be entered
                        ->rules(['integer']) // Adds a validation rule to ensure the value is an integer
                        ->required() // Optional: Makes the field required
                        ->placeholder('Enter an integer')
                        ->helperText('Please enter a whole number.')
                        ->label('Logo Size')
                ]),

                // Favicon

                Section::make('Brand Favicon')
                ->description('Dynamically Set Your Company Brand Favicon')
                ->aside()
                ->schema([
                    FileUpload::make('favicon')
                        ->image()
                        ->directory('/images/mics/favicon')
                        ->label('Your Brand Favicon'),
                    TextInput::make('fav_size')
                        ->numeric() // Ensures only numeric values can be entered
                        ->rules(['integer']) // Adds a validation rule to ensure the value is an integer
                        ->required() // Optional: Makes the field required
                        ->placeholder('Enter an integer')
                        ->helperText('Please enter a whole number.')
                        ->label('Favicon Logo Size')
                ]),

                //

                Section::make('Brand Settings')
                ->description('Your Company must have a brand name and meta description to enhance SE0')
                ->aside()
                ->schema([
                    TextInput::make('brand_name')->rule(['required', 'max:255']),
                    RichEditor::make('meta_description')->required(),
                ]),

                // Seo Sections
                Section::make('Page SEO Optimizations')->description('Set page seo meta descriptions for each page to enhance SEO Visibility')
                ->aside()
                ->schema([
                    Textarea::make('services_description')->label('Services Description'),
                    Textarea::make('about_us_description')->label('About Us Page'),
                    Textarea::make('join_us_seo')->label('Join Us Page'),
                    Textarea::make('blog_seo')->label('Blog Page Seo'),
                ]),

                Section::make('Select Brand Colors')
                ->description('Select your colors for the interface')
                ->aside()
                ->schema([
                    ColorPicker::make('primary_color')
                    ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/'),
                    ColorPicker::make('secondary_color')
                    ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/'),
                    ColorPicker::make('btn_color')
                    ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/'),

                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('logo')
                    ->url(fn($record) => asset('storage/' . $record->logo))
                    ->defaultImageUrl(url('/images/herosection/default.png'))
                    ->label('Logo Image'),

                    ImageColumn::make('favicon')
                    ->url(fn($record) => asset('storage/' . $record->favicon))
                    ->defaultImageUrl(url('/images/herosection/default.png'))
                    ->label('Favicon Image '),

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
            'index' => Pages\ListMiscs::route('/'),
            'create' => Pages\CreateMiscs::route('/create'),
            'edit' => Pages\EditMiscs::route('/{record}/edit'),
        ];
    }
}
