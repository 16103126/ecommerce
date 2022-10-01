<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'transaction_id', 'type', 'charge', 'remark'
    ];

    public function order()
    {
        return $this->hasOne(Order::class)->withDefault();
    }
}
