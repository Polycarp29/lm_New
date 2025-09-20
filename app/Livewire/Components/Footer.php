<?php

namespace App\Livewire\Components;

use App\Models\Footer as GetFooter;
use Livewire\Component;

class Footer extends Component
{

    public $getFooter;

    public function mount()
    {
        $this->getFooterData();
    }


    public function getFooterData()
    {
        $this->getFooter = GetFooter::where('isvisible', true)->get();
    }

    public function render()
    {
        return view('livewire.components.footer');
    }
}
