<?php

namespace App\Livewire\UserDashboard;

use App\Models\Payment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PaymentsOverview extends Component
{
    public $cardtitle = 'Payment Overview';

    public $description = "Your payment details will appear here immediately your task is approved.";

    protected $userDetails;

    public $getPaymentDetails;

    public function mount()
    {
        $this->getPaymentOverview();
    }

    public function getPaymentOverview()
    {
        $this->userDetails = Auth::user();

        $this->getPaymentDetails = Payment::where('user_id', $this->userDetails->id)->get()->take(5);

    }
    public function render()
    {
        return view('livewire.user-dashboard.payments-overview');
    }
}
