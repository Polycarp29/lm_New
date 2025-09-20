<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginForm extends Component
{

    public $title = 'Welcome Back';

    public $description  = 'Enter your email and password to sign in';


    public $email;

    public $password;

    public $remember = false;

    // Monitor form submission

    public $isFormSubmitted = false;

    public function mount()
    {
        // $this->login();
        $this->resetValidation();
    }

    public function login()
{

    $this->isFormSubmitted = true;
    $credentials = $this->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if (Auth::attempt($credentials, $this->remember)) {
        return redirect()->intended('dashboard');
    }

    session()->flash('error', 'Invalid credentials!');
}




    public function render()
    {
        return view('livewire.user.login-form');
    }
}
