<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailPreferences extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_assigned',
        'reviews_posted',
        'payment_notifications',
        'task_approval',
        'task_submission',
        'news_letter',
    ];

    public function user()
    {
        return  $this->belongsTo(User::class);
    }
}
