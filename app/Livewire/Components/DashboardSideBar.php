<?php

namespace App\Livewire\Components;

use App\Models\Miscs;
use Whoops\Util\Misc;
use Livewire\Component;

class DashboardSideBar extends Component
{

    public $data;


    public function mount()
    {
        $this->fetchData();
    }


    public function  fetchData()
    {
        $this->data = Miscs::first();
    }
    public function render()
    {
        return view('livewire.components.dashboard-side-bar');
    }
}
