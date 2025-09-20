<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOpeningData extends Model
{

    use HasFactory;

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'email',
        'phone_number',
        'open_positions_id',
        'cv',
    ];

    public function openposition()
    {
        return $this->belongsTo(OpenPositions::class);
    }
}
