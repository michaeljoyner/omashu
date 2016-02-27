<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/21/16
 * Time: 7:02 PM
 */

namespace Omashu\Orders;


use Omashu\Events\OrderWasPlaced;
use Omashu\Shipping\ShippingService;
use Omashu\Shopping\CartAccess;
use Omashu\Stock\Product;

class OrderService
{

    /**
     * @var CartAccess
     */
    private $cartAccess;
    private $orderNumber;
    private $model = null;
    /**
     * @var ShippingService
     */
    private $shippingService;

    public function __construct(CartAccess $cartAccess, ShippingService $shippingService)
    {
        $this->cartAccess = $cartAccess;
        $this->orderNumber = (new \DateTime())->format('Ymd').str_random(4);
        $this->shippingService = $shippingService;
    }

    public function orderNumber()
    {
        return $this->orderNumber;
    }

    public function placeOrder($request)
    {
        $orderData = [
            'order_number' => $this->orderNumber,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'customer_query' => $request->customer_query,
            'address' => $request->address,
            'total_price' => $this->getTotalOrderPrice()
        ];

        $this->model = Order::create($orderData);

        $this->cartAccess->getCartContents()->each(function($cartItem) {
            $product = Product::findOrFail($cartItem->id);
            $this->model->addItem([
                'description' => $product->name . ' - ' . $product->quantifier,
                'quantity' => $cartItem->qty,
                'unit_price' => $product->price,
                'product_id' => $product->id
            ]);
        });

        $this->cartAccess->emptyCart();

        event(new OrderWasPlaced($this->model));

        return $this->model;
    }

    private function getTotalOrderPrice()
    {
        return $this->cartAccess->totalPrice() + $this->shippingService->getFeeForAmountOf($this->cartAccess->totalPrice());
    }

}