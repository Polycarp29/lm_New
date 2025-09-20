<?php

namespace App\Livewire\Pages\User\Actions;

use App\Models\User;
use Livewire\Component;
use App\Models\UserProfiles;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserActivities\UserSettings;

class Profile extends Component
{

    use WithFileUploads;

    #[Layout('components.layouts.main')]

    public $userData, $user, $avatar;

    public $editFname, $editLname, $editPhone, $editBio, $editEmail, $current_password, $password, $password_confirmation;

    public $emailTurnOn, $smsTurnOn, $loginAttemptsTurnOn;

    public $modal, $updateEmailModal, $updatePasswordModal = false, $isEditing = false;


    public function mount()
    {
        $this->user = Auth::user();

        $this->fetchUserProfile();



        $settings = UserSettings::firstOrCreate(
            ['user_id' => auth()->id()],
            [
                'turn_on_email_updates' => true,
                'send_sms_alerts' => false,
                'notify_login_attempts' => true,
            ]
        );

        $this->emailTurnOn = $settings->turn_on_email_updates;
        $this->smsTurnOn = $settings->send_sms_alerts;
        $this->loginAttemptsTurnOn = $settings->notify_login_attempts;

    }

    public function fetchUserProfile()
    {
        $this->userData = UserProfiles::where('user_id', $this->user->id)->first();
        $this->editEmail  = $this->user->email;
        $this->editFname = $this->userData->fname ?? '';
        $this->editLname = $this->userData->lname ?? '';
        $this->editBio = $this->userData->bio ?? '';
        $this->editPhone = $this->userData->phone_number ?? '';
    }


    public function editProfile()
    {

        $this->modal = true;
    }


    public function openPasswordModal()
    {
        $this->updatePasswordModal = true;
    }


    public function closePasswordModal()
    {
        $this->updatePasswordModal = false;
    }

    public function closeEditModal()
    {
        $this->resetEditFields();
        $this->modal = false;
    }


    public function closeEmailModal()
    {
        $this->resetEditFields();
        $this->updateEmailModal = false;
    }

    public function resetEditFields()
    {
        $this->editFname = '';
        $this->editLname = '';
        $this->editPhone = '';
        $this->editBio = '';
    }

    public function updateProfile()
    {
        $this->validate([
            'editFname' => 'required|string|max:255',
            'editLname' => 'required|string|max:255',
            'editPhone' => 'required|string|max:15',
            'editBio' => 'nullable|string|max:500',
        ]);

        UserProfiles::updateOrCreate( // ✅ Correct: calling on model class
            [
                'user_id' => $this->user->id,
            ],
            [
                'fname' => $this->editFname,
                'lname' => $this->editLname,
                'phone_number' => $this->editPhone,
                'bio' => $this->editBio,
            ]
        );

        $this->dispatch('showToast', message: 'Profile information  updated', type: 'success');
        $this->fetchUserProfile();
        $this->closeEditModal();
    }


    // Open Email Edit modal

    public function updateemail()
    {
        $this->validate([
            'editEmail' => 'required|email',
        ]);

        User::updateOrCreate(
            [
                'id' => $this->user->id,
            ],
            [
                'email' => $this->editEmail,
            ]
        );

        return $this->dispatch('showToast', message: 'Email Changed successfully', type: 'success');
    }


    public function toggleEmail()
    {
        $this->emailTurnOn = !$this->emailTurnOn;

        UserSettings::updateOrCreate(
            ['user_id' => $this->user->id],
            ['turn_on_email_updates' => $this->emailTurnOn]
        );

        $this->dispatch('showToast', message: 'Email preference updated.', type: 'success');
    }

    public function toggleSms()
    {
        $this->smsTurnOn = !$this->smsTurnOn;

        UserSettings::updateOrCreate(
            ['user_id' => $this->user->id],
            ['send_sms_alerts' => $this->smsTurnOn]
        );

        $this->dispatch('showToast', message: 'SMS preference updated.', type: 'success');
    }

    public function toggleLoginAttempts()
    {
        $this->loginAttemptsTurnOn = !$this->loginAttemptsTurnOn;

        UserSettings::updateOrCreate(
            ['user_id' => $this->user->id],
            ['notify_login_attempts' => $this->loginAttemptsTurnOn]
        );

        $this->dispatch('showToast', message: 'Login alert preference updated.', type: 'success');
    }


    public function updatePassword()
    {
        $this->validate(
            [
                'current_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]
        );

        // Check if current password is correct
        if (!Hash::check($this->current_password, $this->user->password)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'current_password' => 'Your current password is incorrect.',
            ]);
        }

        $this->user->password = bcrypt($this->password);
        $this->user->save();


        return $this->dispatch('showToast', message: 'Password updated successfully', type: 'success');
    }

    public function openEmailModal()
    {

        $this->updateEmailModal = true;
    }
    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024', // 1MB Max
        ]);

        $path = $this->avatar->store('avatars', 'public');

        UserProfiles::updateOrCreate([
            'user_id' => $this->user->id,
        ], [
            'avatar' => $path
        ]);

        $this->dispatch('showToast', message: 'Profile picture updated', type: 'success');

        $this->reset('avatar');

        // Refresh user's avatar data (optional, if you want to reload image immediately)
        $this->dispatch('refreshAvatar');
    }
    public function render()
    {
        return view('livewire.pages.user.actions.profile');
    }
}
