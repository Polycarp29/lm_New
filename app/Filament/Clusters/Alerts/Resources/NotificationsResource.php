<?php

namespace App\Filament\Clusters\Alerts\Resources;

use Log;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Notifications;
use Filament\Resources\Resource;
use App\Filament\Clusters\Alerts;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Alerts\Resources\NotificationsResource\Pages;
use App\Filament\Clusters\Alerts\Resources\NotificationsResource\RelationManagers;

class NotificationsResource extends Resource
{
    protected static ?string $model = Notifications::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?string $cluster = Alerts::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('notifiable_type')->sortable(),
                TextColumn::make('type'),
                TextColumn::make('notifiable_type'),
                TextColumn::make('data')
                ->label('Message')
                ->html() // Important to render HTML
                ->formatStateUsing(function ($state) {
                    $decoded = json_decode($state, true);

                    if (!$decoded || !is_array($decoded)) {
                        return '<pre>' . e($state) . '</pre>';
                    }

                    $title = e($decoded['title'] ?? 'No Title');
                    $message = e($decoded['message'] ?? 'No Message');

                    return <<<HTML
                        <div class="bg-gray-600">
                            <strong>Title:</strong> {$title}<br>
                            <strong>Message:</strong><br>
                            <pre>{$message}</pre>
                        </div>
                    HTML;
                }),

            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('send')
            ->label('Send')
            ->button()
            ->color('primary')
            ->action(function ($record, $livewire) {
                // Your custom logic to send the message
                $data = json_decode($record->data, true);
                dd($record->data);
                $title = $data['title'] ?? '';
                $message = $data['message'] ?? '';

                // Get the notification
                Log::info('This are the parameters', [
                    'title' => $title,
                    'message' => $message,

                ]);
            })
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotifications::route('/create'),
            'edit' => Pages\EditNotifications::route('/{record}/edit'),
        ];
    }
}
