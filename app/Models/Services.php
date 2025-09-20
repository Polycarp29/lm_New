<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_header',
        'description',
        'icon',
    ];

    public function quote()
    {
       return  $this->hasMany(Quote::class, 'service_id');
    }


    public function servicepricing()
    {
        return $this->hasOne(ServicesPricing::class, 'services_id');
    }
}
