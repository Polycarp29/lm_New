<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\BannerBars;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\Banner_image;
use App\Models\AboutUsBanner;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AboutUsBannerResource\Pages;
use App\Filament\Resources\AboutUsBannerResource\RelationManagers;

class AboutUsBannerResource extends Resource
{
    protected static ?string $model = AboutUsBanner::class;

    protected static ?string $navigationIcon = 'heroicon-m-rectangle-group';

    protected static ?string $navigationLabel = 'About Us';

    protected static ? string $navigationGroup = 'Home Page Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //

                Tabs::make('Home About Us Banner')->tabs([
                    // Decription and Header
                    Tab::make('Main Content')->schema([
                        TextInput::make('header')->required()->label('Main Header')->afterStateUpdated(function ($state) {
                            self::saveFirstTab($state, 'header');
                        }),
                        RichEditor::make('description')
                            ->required()
                            ->toolbarButtons([
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
                            ])->afterStateUpdated(function ($state) {
                                self::saveFirstTab($state, 'description');
                            }),
                    ]),

                    // Banner Image
                    Tab::make('Banner Image')->schema([
                        Select::make('about_us_banner_id')
                            ->options(AboutUsBanner::all()->pluck('header', 'id'))
                            ->searchable()
                            ->required()
                            ->label('Conf ID')->afterStateUpdated(function ($state) {
                                self::saveSecondTab($state, 'about_us_banner_id');
                            }),
                        FileUpload::make('banner_image')
                            ->image()
                            ->disk('public')  // Ensure you're using the public disk
                            ->directory('images/bannerImage')
                            ->label('Banner Image')
                            ->afterStateUpdated(function ($state) {
                                // Store the file and get the correct path relative to the 'public' disk
                                $path = $state->store('images/bannerImage', 'public');
                                // Save the correct path in the model
                                self::saveSecondTab($path, 'banner_image');
                            }),

                        TextInput::make('alt')->label('Alt Image')->required()->afterStateUpdated(function ($state) {
                            self::saveSecondTab($state, 'alt');
                        })
                    ]),



                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('header')
                ->description( fn(AboutUsBanner $banner) => strip_tags(Str::limit($banner->description))),
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
            'index' => Pages\ListAboutUsBanners::route('/'),
            'create' => Pages\CreateAboutUsBanner::route('/create'),
            'edit' => Pages\EditAboutUsBanner::route('/{record}/edit'),
        ];
    }


    // Define Independent Saving Logic

    protected  static function saveFirstTab($value, $field)
    {
        // Retrieve the first record or create a new one
        $mainModel = AboutUsBanner::first() ?? new AboutUsBanner();

        // Ensure 'description' is always set to avoid errors
        if ($field !== 'description' && is_null($mainModel->description)) {
            $mainModel->description = ''; // Provide a default value if not already set
        }

        // Set the field value
        $mainModel->{$field} = $value;

        // Save the model
        $mainModel->save();

        return $value;
    }


    protected static function saveSecondTab($value, $field)
    {
        $secondModel = Banner_image::first() ?? new Banner_image();

        // If we are saving the banner image, set the correct file path
        if ($field === 'banner_image') {
            // Save the actual path (relative to the public disk)
            $secondModel->banner_image = $value;
        } elseif ($field === 'alt') {
            $secondModel->alt = $value;
        }

        $secondModel->save();

        return $value;
    }



}
