<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesPricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'services_id',
        'price',
        'isActie',
    ];


    public function services()
    {
        return $this->belongsTo(Services::class, 'services_id');
    }
}
