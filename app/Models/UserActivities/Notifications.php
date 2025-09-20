<?php

namespace App\Models\UserActivities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'user_notifications';
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'status_color',
        'read_at',
    ];
}
