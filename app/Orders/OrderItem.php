<?php

namespace Omashu\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'description',
        'quantity',
        'unit_price',
        'product_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
