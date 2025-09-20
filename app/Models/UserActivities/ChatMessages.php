<?php

namespace App\Models\UserActivities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatMessages extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'content',
        'reciever_id',
    ];


    public function chatAttachments()
    {
        return $this->hasMany(ChatAttachments::class, 'chat_messages_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reciever()
    {
        return $this->belongsTo(User::class, 'reciever_id');
    }
}
