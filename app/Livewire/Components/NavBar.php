<?php

namespace App\Livewire\Components;

use App\Models\Miscs;
use Livewire\Component;

class NavBar extends Component
{

    public $navData;

    public function mount()
    {
        $this->getData();
    }


    public function getData()
    {
        $this->navData = Miscs::all();
    }
    public function render()
    {
        return view('livewire.components.nav-bar');
    }
}
