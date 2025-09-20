<?php

namespace App\Http\Controllers;

use App\Models\AccountDetails;
use App\Models\Task;
use App\Models\Miscs;
use App\Models\Invoice;
use App\Models\UserProfiles;
use Illuminate\Http\Request;
use App\Models\RegisterCompany;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Controller
{
    //

    public function  index()
    {
        return view('livewire.user-dashboard.auth.login');
    }




    public function register()
    {
        return view('livewire.user.register-form');
    }

    public function dashboard()
    {
        // Check if user is authenticated

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $getUserDetails = Auth::user();


        return view('livewire.pages.user.main-dashboard', compact('getUserDetails'));
    }

    public function userProfile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userDetails = Auth::user();

        $profileDetails =  UserProfiles::where('user_id', $userDetails->id)->get();

        return view('livewire.pages.profile', compact('profileDetails'));
    }

    public function tasksPage()
    {
        return view('livewire.user-dashboard.pages.tasks-page');
    }


    public function payments()
    {
        return view('livewire.user-dashboard.pages.payments-page');
    }



    public function generatePdf($task_id)
    {
        $userId = Auth::id();

        $generate = Task::with(['user', 'payments'])->where('id', $task_id)->get();
        $userDetails = UserProfiles::where('user_id', $userId)->get();
        $companyDetails = RegisterCompany::all();


        $datePrefix = now()->format('Ymd'); // e.g., 20250119
        $lastInvoice = Invoice::where('invoice_number', 'like', "$datePrefix%")
                              ->orderBy('invoice_number', 'desc')
                              ->first();

        $lastNumber = $lastInvoice ? intval(substr($lastInvoice->invoice_number, -4)) : 0;
        $newInvoiceNumber = $datePrefix . '-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        $invoice = Invoice::create([
            'invoice_number' => $newInvoiceNumber,
            'user_id' => $userId,
            'task_id' => $task_id,
            // Other invoice data
        ]);

        $getLogo = Miscs::all();

        $accountDetails = AccountDetails::where(['user_id' => $userId])->get();




        $pdf = Pdf::loadView('livewire.user-dashboard.p-d-fs-payment-reciept', compact('generate', 'userDetails', 'companyDetails',  'newInvoiceNumber', 'getLogo', 'accountDetails'));

        return $pdf->download('payment-receipt.pdf');
    }


    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the current session
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent token mismatch issues
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('login')->with('status', 'You have been logged out successfully.');
    }
}
