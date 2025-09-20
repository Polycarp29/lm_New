<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use App\Mail\RequestAnalysis As SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\RequestAnalysis as RequestModel;

class RequestAnalysis extends Component
{
    public  $placeholder = 'Your website URL...';

    public $request_btn = "Request Analysis";


    public $address; // To bind the input field data

    public $email;

    public $name;
    public $isModalOpen = false; // Tracks modal visibility


    public function create()
    {
        // Validate First

        $this->validate([
            'address' => 'required|string|max:255',
        ]);

        // Store In Session

        session(['address' => $this->address]);

        // Open Modal

        $this->isModalOpen = true;
    }

    public  function closeModal()
    {
        $this->isModalOpen = false;
    }


    // Submit Details and Save

    public function submit()
    {
        // Ensure address is fetched from session if not set
        if (!$this->address) {
            $this->address = session('address');
        }

        // Validate user inputs
        $this->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:100',
        ]);


        // Save data to the database
        $save = RequestModel::create([
            'address' => $this->address,
            'email' => $this->email,
            'name' => $this->name,
        ]);

        if ($save) {
            // Process Official Mail.
            Mail::to($this->email)->send(new SendMail([
                'name' => $this->name,
                'email' =>$this->email,
                'address' => $this->address,
            ]));
            session()->flash('message', 'Request sent successfully!');
            $this->reset(['email', 'name']); // Reset fields
        } else {
            session()->flash('error', 'Failed to save request.');
        }
    }

    public function render()
    {
        return view('livewire.actions.request-analysis');
    }
}
