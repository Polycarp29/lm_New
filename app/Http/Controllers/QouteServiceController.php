<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Models\QoutesInvoices;
use App\Models\RegisterCompany;
use Barryvdh\DomPDF\Facade\Pdf;

class QouteServiceController extends Controller
{
    //


    public function index($serviceId)
    {
        $serviceprice = '';
        $serviceDescription = '';
        $serviceHeader = '';
        $companyDetails = RegisterCompany::first();
        $datePrefix = now()->format('Ymd');
        $lastInvoice = QoutesInvoices::where('qoute_invoice_no', 'like', "{$datePrefix}%")
                             ->orderByRaw("CAST(qoute_invoice_no AS UNSIGNED) DESC")
                             ->first();

        $lastNumber = $lastInvoice ? intval(substr($lastInvoice->quote_invoice_no, -4)) : 0;
        $newInvoiceNumber = $datePrefix . '-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);


        $getServicePrice = Services::with(['servicepricing'])->first();
        if($getServicePrice)
        {
            // Initiate Variables here
            $serviceprice = $getServicePrice->servicepricing->price;
            $serviceDescription = $getServicePrice->description;
            $serviceHeader = $getServicePrice->service_header;
            $getlogo = $companyDetails->logo;
        }


        QoutesInvoices::create([
            'qoute_invoice_no' => $newInvoiceNumber,
            'service_id' => $serviceId
        ]);
        $pdf = Pdf::loadView('livewire.qoute-invoices.qoute', compact('getlogo', 'serviceprice', 'serviceDescription', 'serviceHeader', 'serviceId', 'companyDetails'));

        return $pdf->download('service_qoute.pdf');
    }
}
