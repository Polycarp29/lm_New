<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PasswordChange;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPassword extends Component
{

    public $token;
    public $email;
    public $password;

    // public $user;

    public $password_confirmation;


    #[Layout('components.layouts.app')]

    public function mount($token)
    {
        $this->token = $token;
        // $this->user = Auth::user();
    }

    public function resetPassword()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);


        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));

                $user->notify(new PasswordChange($this->email));
                $this->dispatch('showToast', message: 'Password reset has been successfull', type: 'success');
            }
        );

        if ($status === Password::PASSWORD_RESET) {

            return redirect()->route('login')->with('status', __($status));
        } else {
            $this->addError('email', __($status));
        }
    }
    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
