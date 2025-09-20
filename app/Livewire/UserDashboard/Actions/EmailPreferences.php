<?php
namespace App\Livewire\UserDashboard\Actions;

use App\Models\EmailPreferences as ModelsEmailPreferences;
use Livewire\Component;

class EmailPreferences extends Component
{
    public $task_assigned, $reviews_posted, $payment_notifications, $task_approval, $task_submission, $news_letter;

    public function mount()
    {
        $userPreferences = ModelsEmailPreferences::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'task_assigned' => true,
                'reviews_posted' => true,
                'payment_notifications' => false,
                'task_approval' => true,
                'task_submission' => false,
                'news_letter' => false,
            ]
        );

        $this->task_assigned = $userPreferences->task_assigned;
        $this->reviews_posted = $userPreferences->reviews_posted;
        $this->payment_notifications = $userPreferences->payment_notifications;
        $this->task_approval = $userPreferences->task_approval;
        $this->task_submission = $userPreferences->task_submission;
        $this->news_letter = $userPreferences->news_letter;
    }

    public function updated($propertyName, $value)
    {
        ModelsEmailPreferences::where('user_id', auth()->id())
            ->update([$propertyName => $value]);
    }

    public function render()
    {
        return view('livewire.user-dashboard.actions.email-preferences');
    }
}
