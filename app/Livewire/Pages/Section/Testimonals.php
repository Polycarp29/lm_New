<?php

namespace App\Livewire\Pages\Section;

use App\Models\Testimonials as Testimony;
use Livewire\Component;


class Testimonals extends Component
{
    public $testimonialData ;
    public function mount()
    {
        $this->getRelatedData();
    }


    public function getRelatedData()
    {
        $this->testimonialData = Testimony::get();
    }
    public function render()
    {
        return view('livewire.pages.section.testimonals');
    }
}
