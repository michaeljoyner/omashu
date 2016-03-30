<?php

namespace Omashu\Orders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'name',
        'email',
        'phone',
        'address',
        'total_price',
        'shipping_fee',
        'customer_query',
    ];

    protected $dates = ['deleted_at'];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function addItem($item)
    {
        return is_array($item) ? $this->items()->create($item) : $this->items()->save($item);
    }

    public function setPaidStatus($hasBeenPaid)
    {
        return $this->toggleBooleanAttribute('is_paid', $hasBeenPaid);
    }

    public function setShippedStatus($hasBeenShipped)
    {
        return $this->toggleBooleanAttribute('is_shipped', $hasBeenShipped);
    }

    public function setCancelledStatus($cancelled)
    {
        return $this->toggleBooleanAttribute('is_cancelled', $cancelled);
    }

    public function status()
    {
        if($this->is_cancelled) {
            return 'cancelled';
        }

        if($this->is_shipped) {
            return $this->is_paid ? 'complete' : 'shipped';
        }

        if($this->is_paid) {
            return 'paid';
        }

        return 'open';
    }

    public function archive()
    {
        $this->delete();
    }

    public function scopeArchived($query)
    {
        return $query->withTrashed()->whereNotNull('deleted_at');
    }

    protected function toggleBooleanAttribute($attributeName, $setTo)
    {
        $this->{$attributeName} = $setTo;
        $this->save();

        return $this->{$attributeName};
    }
}
