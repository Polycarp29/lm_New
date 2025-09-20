<?php

namespace App\Livewire\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{


    public $email;


    #[Layout('components.layouts.app')]
    public function sendResetLink()
    {
        $this->validate(
            [
                'email' => 'required|email|exists:users,email',
            ]
        );

        $status = Password::sendResetLink(['email' => $this->email]);
        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
        } else {
            $this->addError('email', __($status));
        }
    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
