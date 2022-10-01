<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name', 'order_id', 'quantity', 'price', 'tax'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class)->withDefault();
    }
}
