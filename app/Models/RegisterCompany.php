<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'city',
        'postal_code',
        'state',
        'country',
        'email'
    ];
}
