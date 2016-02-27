<?php

namespace Omashu\Shipping;

use Illuminate\Database\Eloquent\Model;

class ShippingRule extends Model
{
    protected $table = 'shipping_rules';

    protected $fillable = [
        'name',
        'rate',
        'free_above'
    ];
}
