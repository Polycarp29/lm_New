<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterActionForm extends Component
{

    public $title = 'Register';

    public $description = 'Regisiter on lee marketing services';

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public $isFormSubmitted = false;
    public function mount()
    {
        $this->resetValidation();
        // $this->register();
    }
    public function register()
    {


        // Change Submission True

        $this->isFormSubmitted = true;
        // Validate the input data
        $credentialData = $this->validate([
            'name' => 'required|string|max:11|min:4|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $credentialData['name'],
            'email' => $credentialData['email'],
            'password' => Hash::make($credentialData['password']),
        ]);

        // Optionally log the user in
        Auth::login($user);

        $user->assignRole('user');

        // Flash a success message or redirect
        session()->flash('message', 'Registration successful!');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.user.register-action-form');
    }
}
