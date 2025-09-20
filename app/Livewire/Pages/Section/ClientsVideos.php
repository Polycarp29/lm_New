<?php

namespace App\Livewire\Pages\Section;

use App\Models\ClientsTestimonailVidoes;
use Livewire\Component;

class ClientsVideos extends Component
{


    public  $fetchVideos;
    public function mount()
    {
        $this->getVideos();
    }

    public function  getVideos()
    {
        $this->fetchVideos = ClientsTestimonailVidoes::get();
    }
    public function render()
    {
        return view('livewire.pages.section.clients-videos');
    }
}
