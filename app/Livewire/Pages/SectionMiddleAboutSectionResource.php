<?php

namespace App\Livewire\Pages;

use App\Models\MiddleAboutSection;
use Livewire\Component;

class SectionMiddleAboutSectionResource extends Component
{

    public $middleData;

    public function mount()
    {
        $this->getRelatedData();
    }


    public function getRelatedData()
    {
        $this->middleData = MiddleAboutSection::get();
    }
    public function render()
    {
        return view('livewire.pages.section-middle-about-section-resource');
    }
}
