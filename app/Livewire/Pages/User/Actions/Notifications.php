<?php

namespace App\Livewire\Pages\User\Actions;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\UserActivities\ChatMessages;
use App\Models\UserActivities\ChatAttachments;
use App\Models\UserActivities\Notifications as Notify;
use App\Notifications\ChatMessageNotification;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Notifications extends Component
{
    use WithFileUploads, WithPagination;

    public $messages;
    public $attachments;
    public $currentUserId;
    public $messageText = '';
    public $file;
    public $selectedUserId = null;
    public $selectedUserName = '';

    #[Layout('components.layouts.main')]
    public function mount()
    {
        $this->currentUserId = auth()->id();
        $this->messages = collect();

    }

    #[On('refreshChat')]
    public function sendMessage()
    {
        // $this->validate([
        //     'messageText' => 'nullable|string',
        //     'file' => 'nullable|file|max:10240',
        // ]);

        if (!$this->selectedUserId) {
            session()->flash('error', 'Please select a user to chat with.');
            return;
        }


        // Create the message
        $message = ChatMessages::create([
            'user_id' => $this->currentUserId,
            'reciever_id' => $this->selectedUserId,
            'content' => $this->messageText,
        ]);

        // Handle file upload
        if ($this->file) {
            $path = $this->file->store('chat_attachments', 'public');
            ChatAttachments::create([
                'chat_messages_id' => $message->id,
                'attachment' => $path,
            ]);
        }
        $senderName = User::find($this->currentUserId);
        $recieverName = User::find($this->selectedUserId);

        // Clear the input fields
        $this->messageText = '';
        $this->file = null;

        // User::find($this->recieverName)->notify(new ChatMessageNotification(  $recieverName->name));

        // Reload messages and update the collection
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = ChatMessages::with(['user', 'chatAttachments'])
            ->where(function ($query) {
                $query->where('user_id', $this->currentUserId)
                    ->where('reciever_id', $this->selectedUserId);
            })
            ->orWhere(function ($query) {
                $query->where('user_id', $this->selectedUserId)
                    ->where('reciever_id', $this->currentUserId);
            })
            ->orderBy('created_at')
            ->get();
    }




    public function selectUser($userId)
    {
        $user = User::findOrFail( $userId);

        $this->selectedUserId = $user->id;
        $this->selectedUserName = $user->name;
        $this->loadMessages();
    }


    public function render()
    {
        return view('livewire.pages.user.actions.notifications', [
            'notifications' => Notify::where('user_id', auth()->id())->latest()->paginate(10),
            'users' => User::with('userdetails')->where('id', '!=', Auth::id())->get(),
        ]);
    }
}
