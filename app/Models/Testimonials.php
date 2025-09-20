<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_title',
        'avatar',
        'description',
        'Client_name',
        'company_name',
    ];
}
