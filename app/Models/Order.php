<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'customer_id',
        'total',
        'shipping_date',
        'is_delivery',
        'is_paid',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
