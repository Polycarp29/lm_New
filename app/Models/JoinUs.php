<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'header',
        'description',
    ];

    public function openpositions()
    {
        return $this->hasOne(OpenPositions::class);
    }

}
