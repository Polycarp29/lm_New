<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Component;
use App\Models\UserProfiles;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $profileDetails, $authUser;
    public $showEditModal, $updateEmailModal, $updatePasswordModal = false;
    public $editFname, $editLname, $editPhone, $editBio, $editEmail;

    public function mount()
    {
        $this->fetchProfile();
    }

    public function fetchProfile()
    {
        $this->authUser = Auth::user();
        $this->profileDetails = UserProfiles::with('user')->where('user_id', $this->authUser->id)->get();
    }

    public function openEditModal()
    {
        $profile = $this->profileDetails->first();
        $this->editFname = $profile->fname;
        $this->editLname = $profile->lname;
        $this->editPhone = $profile->phone_number;
        $this->editBio = $profile->bio;
        $this->showEditModal = true;

    }

    // Open Email Edit modal

    public function openEmailModal()
    {
        $this->editEmail  = $this->authUser->email;
        $this->updateEmailModal = true;
    }

    public function closeEditModal()
    {
        $this->resetEditFields();
        $this->showEditModal = false;
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

        $profile = $this->profileDetails->first();
        $profile->update([
            'fname' => $this->editFname,
            'lname' => $this->editLname,
            'phone_number' => $this->editPhone,
            'bio' => $this->editBio,
        ]);

        $this->fetchProfile();
        $this->closeEditModal();
    }

    public function updateemail()
    {
        $this->validate([
            'email' => 'required|email',
        ]);
    }

    public function render()
    {
        return view('livewire.pages.profile');
    }
}
