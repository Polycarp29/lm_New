<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenPositions extends Model
{
    use HasFactory;

    protected $fillable = [
        'joinus_id',
        'job-title',
        'type',
        'job_description',

    ];

    public function joinus()
    {
        return $this->belongsTo(JoinUs::class);
    }


    public function jobopeningadata()
    {
        return $this->hasOne(JobOpeningData::class);
    }
}
