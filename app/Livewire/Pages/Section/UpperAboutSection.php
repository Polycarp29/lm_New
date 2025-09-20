<?php

namespace App\Livewire\Pages\Section;

use Livewire\Component;
use App\Models\UpperAboutSection as UpperSection;

class UpperAboutSection extends Component
{
    public $pageTitle = "About Us";

    public $pageData;


    public function mount()
    {
        //Get Related Data

        $this->getRelatedData();
    }


    public function getRelatedData()
    {
        $this->pageData = UpperSection::get();

    }

    public function render()
    {
        return view('livewire.pages.section.upper-about-section');
    }
}
