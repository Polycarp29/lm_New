<?php

namespace App\Livewire\Section;

use App\Models\LeeMarketingPartners as ModelsLeeMarketingPartners;
use Livewire\Component;

class LeeMarketingPartners extends Component
{

    public $getPartners;


    public function mount()
    {
        $this->fetchPartners();
    }

    public function fetchPartners()
    {
        $this->getPartners = ModelsLeeMarketingPartners::where('isActive', true)->get();
    }
    public function render()
    {
        return view('livewire.section.lee-marketing-partners');
    }
}
