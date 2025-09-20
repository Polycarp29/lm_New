<?php

namespace App\Livewire\Components;

use App\Models\Miscs;
use Livewire\Component;

class UserDashboardLogo extends Component
{
    public $getLogo;

    public function mount()
    {
        $this->getLogo = Miscs::all();
    }
    public function render()
    {
        return view('livewire.components.user-dashboard-logo');
    }
}
