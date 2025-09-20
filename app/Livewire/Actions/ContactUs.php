<?php

namespace App\Livewire\Actions;

use Livewire\Component;

use App\Models\Contact_Us;

use Livewire\Attributes\On;
use DefStudio\Recaptcha\Recaptcha;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use App\Mail\ContactUs as MailContactUs;

class ContactUs extends Component
{

    public $name;
    public $surname;

    public $email;

    public $recaptcha;

    public $message;

    #[On('formSubmitted')]  // Monitor Form Submision
     public function save()
    {
        // Prevent bot submissions via honeypot
        if (!empty($this->honeypot)) {
            return;
        }

        // Rate limiter to prevent spam submissions
        $key = 'form-submission:' . request()->ip() . ':' . request()->userAgent();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'form' => 'Too many attempts. Please wait ' . $seconds . ' seconds before retrying.',
            ]);
        }

        // Register this attempt
        RateLimiter::hit($key, 60);

        // Validate input
        $validatedData = $this->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        // Store form data
        $details = Contact_Us::create($validatedData);

        if ($details) {
            // Send email
            Mail::to($this->email)->send(new MailContactUs([
                'name' => $this->name,
                'email' => $this->email,
                'surname' => $this->surname,
                'message' => $this->message, // Ensure message is passed
            ]));

            // Flash success message
            session()->flash('message', 'Message sent successfully!');
            $this->reset(['name', 'surname', 'email', 'message']);
        } else {
            session()->flash('error', 'Failed to save request.');
        }
    }
    public function render()
    {
        return view('livewire.actions.contact-us');
    }
}
