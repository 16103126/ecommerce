<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id', 'reply', 'file', 'sender_id', 'type'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class)->withDefault();
    }
}
