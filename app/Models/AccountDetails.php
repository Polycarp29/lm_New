<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'methods',
        'account_name',
        'bank_name',
        'mpesa_number',
        'bank_account',
        'paypal_email',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
