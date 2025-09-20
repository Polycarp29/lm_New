<?php

namespace App\Livewire\UserDashboard;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentsComponentTable extends Component
{

    use WithPagination;
    public $queryString = ['transaction_id', 'task_name', 'task_link'];
    public $search = ""; // Search input
    protected $fetchUserDetails;

    public $title = 'Title';

    public function updatingSearch()
    {
        // Reset to the first page when search changes
        $this->resetPage();
    }

    public function mount()
    {
        if (auth()->check()) {
            session(['user' => auth()->user()]);
        } else {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        $user = session('user');

        if (!$user) {
            return view('livewire.user-dashboard.payments-component-table', ['payments' => collect()]);
        }

        $payments = Payment::with(['task'])->where('user_id', $user->id)
            ->search($this->search)
            ->paginate(5);
        return view('livewire.user-dashboard.payments-component-table', ['payments' => $payments]);
    }
}
