<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'bio',
        'id_number',
        'phone_number',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
