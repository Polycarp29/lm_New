<?php

namespace App\Livewire\User\Config;

use App\Models\Miscs;
use Livewire\Component;

class LoginNav extends Component
{

    public $navData;

    public function mount()
    {
        return $this->loadNavigation();
    }

    public function loadNavigation()
    {
        $this->navData = Miscs::all();
    }
    public function render()
    {
        return view('livewire.user.config.login-nav');
    }
}
