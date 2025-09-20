<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\HeroSection as HeroSectionModel;

class HeroSection extends Component
{
    public $heroData;


    public function mount()
    {
        $this->heroSectionData();
    }
    public function heroSectionData()
    {
        $this->heroData = HeroSectionModel::where('isVisible', 1)->get();

    }
    public function render()
    {
        return view('livewire.components.hero-section');
    }
}
