<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/23/16
 * Time: 12:59 PM
 */

namespace Omashu\Invoicing;


class Invoice
{
    public $items;
    public $subtotal;
    public $total;
    public $shipping;

    public function __construct($items, $delivery_fee, $subtotal)
    {
        $this->items = $items;
        $this->subtotal = $subtotal;
        $this->shipping = $delivery_fee;
    }

    public function total()
    {
        return $this->subtotal + $this->shipping;
    }
}