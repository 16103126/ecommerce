<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'receiver_id', 'file', 'message', 'subject', 'type'
    ];

    public function replyTickets()
    {
        return $this->hasMany(ReplyTicket::class);
    }

}
