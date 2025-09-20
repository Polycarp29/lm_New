<?php

namespace App\Livewire\UserDashboard\Components;

use Livewire\Component;
use App\Models\AccountDetails;
use Illuminate\Support\Facades\Auth;

class Accounts extends Component
{
    protected $authUser;
    public $accountDetails;

    public $accountName, $methods, $bank_name, $mpesa_number, $bank_account, $paypal_email;

    public $isModalOpen = false;
    public $isEditing = false;

    public function mount()
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized action.');
        }
        $this->fetchAccountDetails();
    }

    public function fetchAccountDetails()
    {
        $this->authUser = Auth::user();
        $this->accountDetails = AccountDetails::where('user_id', $this->authUser->id)->get();
    }

    public function openModal()
    {
        $accounts = $this->accountDetails->first();

        if ($accounts) {
            $this->accountName = $accounts->account_name;
            $this->methods = $accounts->methods;

            if ($this->methods == 'Bank') {
                $this->bank_name = $accounts->bank_name;
                $this->bank_account = $accounts->bank_account;
            } elseif ($this->methods == 'Mpesa') {
                $this->mpesa_number = $accounts->mpesa_number;
            } else {
                $this->paypal_email = $accounts->paypal_email;
            }

            $this->isEditing = true;
        } else {
            $this->resetEditingFields();
            $this->isEditing = false;
        }

        $this->isModalOpen = true;

        logger('Modal opened');
    }

    public function closeModal()
    {
        $this->resetEditingFields();
        $this->isModalOpen = false;
    }

    public function resetEditingFields()
    {
        $this->accountName = '';
        $this->methods = '';
        $this->bank_name = '';
        $this->mpesa_number = '';
        $this->bank_account = '';
        $this->paypal_email = '';
    }

    public function saveAccountDetails()
    {
        $userId = Auth::id();

        // Normalize method input to match ENUM values
        $this->methods = ucfirst(strtolower($this->methods)); // Ensure case matches ENUM values

        // Validate inputs based on the selected method
        $validatedData = $this->validate([
            'accountName' => 'required|string|max:255',
            'methods' => 'required|in:Bank,Mpesa,Cash,PayPal', // Match ENUM values
            'bank_name' => 'nullable|required_if:methods,Bank|string|max:255',
            'bank_account' => 'nullable|required_if:methods,Bank|string|max:255',
            'mpesa_number' => 'nullable|required_if:methods,Mpesa|string|max:20',
            'paypal_email' => 'nullable|required_if:methods,PayPal|email|max:255',
        ]);

        // Prepare the data for saving with null values for fields that might be method-specific
        $data = [
            'account_name' => $this->accountName,
            'methods' => $this->methods,
            'bank_name' => null,
            'bank_account' => null,
            'mpesa_number' => null,
            'paypal_email' => null,
        ];

        // Set fields based on the selected method
        switch ($this->methods) {
            case 'Bank':
                $data['bank_name'] = $this->bank_name;
                $data['bank_account'] = $this->bank_account;
                break;
            case 'Mpesa':
                $data['mpesa_number'] = $this->mpesa_number;
                break;
            case 'PayPal':
                $data['paypal_email'] = $this->paypal_email;
                break;
            case 'Cash':
                // No additional fields for Cash, but method is set
                break;
        }

        // Check if the method is being updated
        $accountDetails = AccountDetails::where('user_id', $userId)->first();

        // If the method has changed, ensure we reset the previous method's fields.
        if ($accountDetails && $accountDetails->methods !== $this->methods) {
            // Update with new method data
            $accountDetails->update($data);
        } else {
            // If it's a new save or same method, create/update accordingly
            AccountDetails::updateOrCreate(
                ['user_id' => $userId],
                $data
            );
        }

        // Refresh account details and close modal
        $this->fetchAccountDetails();
        $this->closeModal();

        // Flash success message
        session()->flash('message', $this->isEditing ? 'Account details updated successfully!' : 'Account details saved successfully!');
    }


    public function render()
    {
        return view('livewire.user-dashboard.components.accounts');
    }
}
