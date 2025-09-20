<?php

namespace App\Models\Alerts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'data',
    ];
}
