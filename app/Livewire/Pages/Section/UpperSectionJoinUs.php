<?php

namespace App\Livewire\Pages\Section;

use App\Models\JoinUs;
use Livewire\Component;

class UpperSectionJoinUs extends Component
{
    public $getData;
    public function mount()
    {
        $this->getData();
    }

    public function getData()
    {

        $this->getData = JoinUs::get();

    }
    public function render()
    {
        return view('livewire.pages.section.upper-section-join-us');
    }
}
