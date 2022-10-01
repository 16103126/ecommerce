<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'phone_no', 'email', 'shipping_address', 'country', 'state', 'zipecode', 'transaction_id', 'payment_id', 'status', 'payment_status'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class)->withDefault();
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class)->withDefault();
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
