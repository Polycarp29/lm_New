<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';


    protected static ?string $navigationGroup = "Blog";



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Section
                Section::make('Top Section')->schema([
                    TextInput::make('title')->live()->required()->maxLength(150)->afterStateUpdated(function ($operation, $state, Forms\set $set) {
                        $set('slug', Str::slug($state));
                    }),

                    TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(150),

                ])->columns(2),

                // Section

                Section::make('Blog Body')->schema([
                    RichEditor::make('content')
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
                        ])->required()->fileAttachmentsDirectory('posts/images')->columnSpanFull(),
                ]),

                Section::make('Miscs')->schema([
                    FileUpload::make('featured_image')
                        ->image()
                        ->disk('public')
                        ->directory('posts/featured_image')
                        ->label('Featured Image')->required(),

                    DatePicker::make('published_at')->required(),

                    Checkbox::make('featured_post')->required(),
                ])->columns(3),

                Section::make('Bottom Section')->schema([
                    Select::make('tags')->relationship('tags', 'name')->searchable()->multiple()->required(),
                    Select::make('Category')->relationship('categories', 'name')->searchable()->multiple()->required(),
                    Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'archived' => 'Archived',
                            'published' => 'Published',
                        ])
                        ->required()->searchable(),
                ])->columns(3)


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                ImageColumn::make('featured_image')
                    ->url(fn($record) => asset('/storage', $record->featured_image))
                    ->defaultImageUrl(url('/images/featured_image/default.png'))->label('Featured Image'),

                TextColumn::make('title')->sortable()->searchable(),


                BadgeColumn::make('status')
                    ->icons([
                        'heroicon-o-x',
                        'heroicon-o-document' => static fn($state): bool => $state === 'draft',
                        'heroicon-o-arrow-path' => static fn($state): bool => $state === 'archived',
                        'heroicon-o-check-badge' => static fn($state): bool => $state === 'published',
                    ])
                    ->colors([
                        'primary',
                        'secondary' => static fn($state): bool => $state === 'draft',
                        'warning' => static fn($state): bool => $state === 'archived',
                        'success' => static fn($state): bool => $state === 'published',

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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
