<?php

namespace App\Livewire\UserDashboard\Auth;

use Livewire\Component;
use App\Models\UserProfiles;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class UpdateProfileInfo extends Component
{
    use WithFileUploads;

    public $profileDetails, $authUser;
    public $showEditModal = false;
    public $editFname, $editLname, $id_number, $editPhone, $avatar, $editBio;
    public $isEditing = false;

    public function mount()
    {
        $this->fetchProfile();
    }

    public function fetchProfile()
    {
        $this->authUser = Auth::user();
        $this->profileDetails = UserProfiles::where('user_id', $this->authUser->id)->get();
    }

    public function openEditModal()
    {
        $profile = $this->profileDetails->first();

        if ($profile) {
            // Populate fields for editing
            $this->editFname = $profile->fname;
            $this->editLname = $profile->lname;
            $this->id_number = $profile->id_number;
            $this->editPhone = $profile->phone_number;
            $this->editBio = $profile->bio;
            $this->avatar = null; // Reset the avatar field
            $this->isEditing = true;
        } else {
            // Initialize empty fields for creating a new profile
            $this->resetEditFields();
            $this->isEditing = false;
        }

        $this->showEditModal = true;
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
        $this->id_number = '';
        $this->editBio = '';
        $this->avatar = null; // Reset file input
    }

    public function saveProfile()
    {
        $this->validate([
            'editFname' => 'required|string|max:255',
            'editLname' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'editPhone' => 'required|string|max:15',
            'avatar' => 'nullable|image|max:2048', // Validate the uploaded file
            'editBio' => 'nullable|string|max:500',
        ]);

        $filePath = null;

        if ($this->avatar) {
            // Store the uploaded file in a permanent location
            $filePath = $this->avatar->store('uploads/avatars', 'public');
        }

        if ($this->isEditing) {
            // Update existing profile
            $profile = $this->profileDetails->first();
            $profile->update([
                'fname' => $this->editFname,
                'lname' => $this->editLname,
                'phone_number' => $this->editPhone,
                'id_number' => $this->id_number,
                'bio' => $this->editBio,
                'avatar' => $filePath ?? $profile->avatar, // Update only if a new file is uploaded
            ]);
        } else {
            // Create a new profile
            UserProfiles::create([
                'user_id' => $this->authUser->id,
                'fname' => $this->editFname,
                'lname' => $this->editLname,
                'phone_number' => $this->editPhone,
                'id_number' => $this->id_number,
                'bio' => $this->editBio,
                'avatar' => $filePath, // Save the uploaded file path
            ]);
        }

        $this->fetchProfile();
        $this->closeEditModal();
        // Set Flash Message
        session()->flash('message', $this->isEditing ? 'Profile details updated successfully!' : 'Profile details saved successfully!');
    }

    public function render()
    {
        return view('livewire.user-dashboard.auth.update-profile-info');
    }
}
