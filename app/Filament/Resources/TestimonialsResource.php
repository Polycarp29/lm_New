<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\Testimonials;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TestimonialsResource\Pages;
use App\Filament\Resources\TestimonialsResource\RelationManagers;

class TestimonialsResource extends Resource
{
    protected static ?string $model = Testimonials::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = "About Us Page";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Testimonial Data')
                    ->aside()
                    ->description('Include Testimonial Data for clients')
                    ->schema([
                        TextInput::make('position_title')->required()->label("Client's Position Title"),
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
                            ])->required()->fileAttachmentsDirectory('posts/images'),

                        FileUpload::make('avatar')
                            ->image()
                            ->disk('public')
                            ->directory('clients/avatar')
                            ->label('Clients Avatar')->required(),
                        TextInput::make('Client_name')->required()->label('Client Name'),
                        TextInput::make('company_name')->required()->label('Company Name'),
                        Select::make('status')->options([
                            'approved',
                            'rejected',
                            'under-review',
                        ])->required(),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('Client_name')->description(fn(Testimonials $testimonials): string => strip_tags(Str::limit($testimonials->description, 100)))
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonials::route('/create'),
            'edit' => Pages\EditTestimonials::route('/{record}/edit'),
        ];
    }
}
