<?php

namespace App\Filament\Clusters\Alerts\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use App\Models\User;
use App\Notifications\BroadCastMessage;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Filament\Clusters\Alerts;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification as FilamentNotification;


class SendNotificationsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Send Notifications';
    protected static ?string $title = 'Send Notifications';
    protected static string $view = 'filament.clusters.alerts.pages.send-notifications-page';
    protected static ?string $cluster = Alerts::class;

    public ?array $recipients = [];
    public ?string $message = '';
    public ?string $notificationTitle = '';

    public function mount(): void
    {
        $this->form->fill([
            'recipients' => $this->recipients,
            'notificationTitle' => $this->notificationTitle,
            'message' => $this->message,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('recipients')
                ->label('Select Recipients')
                ->options(User::pluck('name', 'id')->toArray())
                ->required()
                ->multiple()
                ->searchable(),

            TextInput::make('notificationTitle')
                ->label('Message Title')
                ->required(),

            Textarea::make('message')
                ->label('Message Content')
                ->required()
                ->rows(4),
        ];
    }

    public function submit()
    {
        $data = $this->form->getState();

        $dataMessage = $data['message'];
        $dataTitle = $data['notificationTitle'];

        $users = User::whereIn('id', $data['recipients'])->get();


        if($dataMessage)
        {
            foreach ($users as $user) {
                $user->notify(new BroadCastMessage($dataMessage, $dataTitle));
            }
        }else{

        }


        FilamentNotification::make()
        ->title('Notifications Sent')
        ->success()
        ->body('Your message was sent successfully to selected users.')
        ->send();

        $this->form->fill([]); // Optionally reset the form
    }

    protected function getFormActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('Send')
                ->label('Send Notification')
                ->submit('submit')
                ->button(),
        ];
    }
}
