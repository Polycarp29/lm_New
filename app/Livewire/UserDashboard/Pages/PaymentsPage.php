<?php

namespace App\Livewire\UserDashboard\Pages;

use App\Models\Task;
use App\Models\Payment;
use Livewire\Component;

class PaymentsPage extends Component
{
        public function render()
    {


        return view('livewire.user-dashboard.pages.payments-page');
    }
}
