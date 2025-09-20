<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{

    public $button_name = 'Request Analysis';
    public function render()
    {
        return view('livewire.pages.home');
    }
}
