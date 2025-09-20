<?php

namespace App\Models\UserActivities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;


    protected $table = 'user_settings';


    protected $fillable = [
        'user_id',
        'turn_on_email_updates',
        'send_sms_alerts',
        'notify_login_attempts'
    ];
}
