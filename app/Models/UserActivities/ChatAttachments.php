<?php

namespace App\Models\UserActivities;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserActivities\ChatMessages;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatAttachments extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_messages_id',
        'attachment',
    ];


    public function chats()
    {
        return $this->belongsTo(ChatMessages::class, 'chat_messages_id');
    }
}
