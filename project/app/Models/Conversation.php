<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'receiver_id', 'message', 'subject'
    ];

    public function replyConversations()
    {
        return $this->hasMany(ReplyConversation::class);
    }
}
