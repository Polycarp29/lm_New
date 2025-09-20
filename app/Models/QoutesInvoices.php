<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QoutesInvoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'qoute_invoice_no',
        'email',
        'service_id',
    ];
}
