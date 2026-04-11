<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'address', 'country', 'state', 'city', 'pin_code',
        'phone_number', 'email', 'total_price', 'payu_id', 'cashfree_order_id',
        'txn_id', 'payment_method', 'payment_status', 'order_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}