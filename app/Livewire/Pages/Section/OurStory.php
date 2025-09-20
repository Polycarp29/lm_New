<?php

namespace App\Livewire\Pages\Section;

use Livewire\Component;

use App\Models\UpperAboutSection;

class OurStory extends Component
{


    public $pageData;
    public function mount()
    {
        //Get Related Data

        $this->getRelatedData();
    }


    public function getRelatedData()
    {
        $this->pageData = UpperAboutSection::get();

    }
    public function render()
    {
        return view('livewire.pages.section.our-story');
    }
}
