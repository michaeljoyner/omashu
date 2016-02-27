<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/23/16
 * Time: 12:55 PM
 */

namespace Omashu\Invoicing;


use Omashu\Shipping\ShippingService;
use Omashu\Shopping\CartAccess;

class InvoiceService
{

    /**
     * @var ShippingService
     */
    private $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function createFromCart(CartAccess $cartAccess)
    {
        $items = $cartAccess->getCartContents()->map(function ($item) {
            return [
                'name'       => $item->name,
                'quantity'   => $item->qty,
                'unit_price' => $item->price
            ];
        });

        $delivery = $this->getShippingFeeFromTotal($cartAccess->totalPrice());

        return new Invoice($items, $delivery, $cartAccess->totalPrice());
    }

    private function getShippingFeeFromTotal($totalPrice)
    {
        return $this->shippingService->getFeeForAmountOf($totalPrice);
    }

}