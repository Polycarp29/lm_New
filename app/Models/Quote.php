<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [

        'service_id',
        'fname',
        'lname',
        'message',
        'email',
        'phone_number',
    ];


    public function service()
    {
       return $this->belongsTo(Services::class);
    }
}
