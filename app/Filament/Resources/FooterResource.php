<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Footer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FooterResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FooterResource\RelationManagers;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';

    protected static ?string $navigationGroup = 'Miscs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Set Contact Description')
                    ->description('Dynamically set a description of what content will appear on the left of the contact form')
                    ->aside()
                    ->schema([
                        TextInput::make('contact_form_header')->required(),
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
                            ])->required(),

                            TextInput::make('contacts')
                                ->tel()
                                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                ->required()

                    ]),

                Section::make('Footer Data')
                    ->description('Dynamically set footer Data')
                    ->aside()
                    ->schema([
                        TextInput::make('footer_copyright')->required(),
                        TextInput::make('botton_desc')->required(),
                    ]),

                Section::make('Visibility')
                    ->description('Choose HomePage Widget Visibility')
                    ->aside()
                    ->schema([
                        Checkbox::make('isvisible')->required()->label('Visible on Homepage ?'),

                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('contact_form_header')->sortable()->searchable()->label('Contact Header'),
                BadgeColumn::make('isvisible')
                    ->icons([
                        'heroicon-o-x-mark',
                        'heroicon-o-document' => static fn($state): bool => $state === '0',
                        'heroicon-o-check-badge' => static fn($state): bool => $state === '1',
                    ])
                    ->colors([
                        'primary',
                        'warning' => static fn($state): bool => $state === '0',
                        'success' => static fn($state): bool => $state === '1',

                    ])
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
            'index' => Pages\ListFooters::route('/'),
            'create' => Pages\CreateFooter::route('/create'),
            'edit' => Pages\EditFooter::route('/{record}/edit'),
        ];
    }
}
