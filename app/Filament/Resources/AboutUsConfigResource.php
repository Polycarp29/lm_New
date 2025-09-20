<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Forms\Components\Button;
use App\Models\AboutUsConfig;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AboutUsConfigResource\Pages;
use App\Filament\Resources\AboutUsConfigResource\RelationManagers;
use Filament\Tables\Columns\CheckboxColumn;

class AboutUsConfigResource extends Resource
{
    protected static ?string $model = AboutUsConfig::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationLabel = 'About Us Config';

    protected static ? string $navigationGroup = 'Home Page Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Tabs::make('Home Page About Us')->tabs([
                    Tab::make('Activate Widget')->schema([
                        Toggle::make('isVisible')->label('Activate About Us Widget'),
                    ]),
                    Tab::make('Home About Us')
                        ->schema([
                            Repeater::make('homeAboutUs')
                                ->relationship('homeAboutUs') // Define the relationship method in AboutUsConfig
                                ->schema([
                                    TextInput::make('header')->required()->label('Header'),
                                    FileUpload::make('icon')
                                        ->image()
                                        ->directory('images/homeAboutUs')
                                        ->label('Item Icon'),
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
                                        ]),
                                    Select::make('about_us_configs_id')
                                        ->relationship('aboutUsConfig', 'id')
                                        ->searchable()
                                        ->required()
                                        ->label('Conf ID'),
                                ])
                                ->columns(2),
                        ]),

                ])->columnSpanFull(),

            ]);
    }


    // Activate Widget
    public function activateWidget(): void
    {
        // Example: Save or update an ID to the database
        AboutUsConfig::create([
            'isVisible' => 'true',
            'activated_at' => now(),       // Optional timestamp
        ]);

        $this->notify('success', 'Widget activated successfully!');
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                CheckboxColumn::make('isVisible')->label('Widget Activated')

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
            'index' => Pages\ListAboutUsConfigs::route('/'),
            'create' => Pages\CreateAboutUsConfig::route('/create'),
            'edit' => Pages\EditAboutUsConfig::route('/{record}/edit'),
        ];
    }
}
