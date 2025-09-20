<?php

namespace App\Livewire;

use App\Models\Footer;
use Livewire\Component;

class HomepageContactUs extends Component
{

    public $description = "Feel Free To Send Us a Message About Your Brand Needs";

    public $getFormData;

    // Mount

    public function mount()
    {
        $this->fetchData();
    }

    public function fetchData()
    {
        $this->getFormData = Footer::where('isvisible', true)->get();

    }

    public $title =" ";
    public function render()
    {
        return view('livewire.homepage-contact-us');
    }
}
