<?php

namespace App\Livewire\Components;

use App\Models\Quote;
use Livewire\Component;
use App\Mail\AskForQoute;
use Illuminate\Support\Facades\Mail;
use App\Models\Services as GetService;

class Services extends Component
{
    public $services;
    public $isModalOpen = false;
    public $serviceId; // To track the selected service
    public $price;
    public $serviceName;
    public $name, $surname, $phone_number, $email, $message;


    public function mount()
    {
        $this->getServices();
    }

    public function getServices()
    {
        $this->services = GetService::where('isactive', true)->get();
    }

    public function openModal($serviceId)
    {
        $this->serviceId = $serviceId;
        $this->isModalOpen = true;
        $service = GetService::find($serviceId);
        $pricing = GetService::with(['servicepricing'])->where('id', $serviceId)->first();
        $this->serviceName = $service->service_header;
        if($pricing)
        {
            $this->price = $pricing->servicepricing->price ?? 'Not Set';
        }
    }

    public function closeModal()
    {
        $this->resetModal();
    }

    public function resetModal()
    {
        $this->isModalOpen = false;
        $this->serviceId = null;
        $this->serviceName = ''; // Reset the service name
        $this->name = '';
        $this->surname = '';
        $this->phone_number ='';
        $this->email = '';
        $this->message = '';
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Simulate saving the quote or send email logic here
        // For instance: Quote::create([...]);

        $save = Quote::create([
            'service_id' => $this->serviceId,
            'fname' => $this->name,
            'lname' => $this->surname,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'message' => $this->message,
        ]);

        if($save){
             Mail::to($this->email)->send(new AskForQoute([
                'serviceId' => $this->serviceId,
                'service_name' => $this->serviceName,
                'fname' => $this->name,
                'lname' => $this->surname,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'message' => $this->message,
            ]
            ));
            session()->flash('message', 'Your request has been submitted successfully!');

        }else {
            session()->flash('error', 'Unable to complete your request' );
        }


    }

    public function render()
    {
        return view('livewire.components.services');
    }
}