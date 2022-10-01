<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id', 'reply_message'
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class)->withDefault();
    }
}
