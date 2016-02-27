<?php

namespace Omashu\Http\Controllers;

use Illuminate\Http\Request;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;
use Omashu\Shipping\ShippingService;
use Omashu\Shopping\CartAccess;

class CartController extends Controller
{
    /**
     * @var CartAccess
     */
    private $cartAccess;
    /**
     * @var ShippingService
     */
    private $shippingService;

    public function __construct(CartAccess $cartAccess, ShippingService $shippingService)
    {
        $this->cartAccess = $cartAccess;
        $this->shippingService = $shippingService;
    }

    public function index()
    {
        return response()->json($this->cartAccess->getCartContents()->toArray());
    }

    public function summary()
    {
        return response()->json([
            'items'    => $this->cartAccess->countItems(),
            'products' => $this->cartAccess->countProducts(),
            'total'    => $this->cartAccess->totalPrice()
        ]);
    }

    public function totals()
    {
        $subtotal = $this->cartAccess->totalPrice();
        $shipping = $this->shippingService->getFeeForAmountOf($subtotal);

        return response()->json([
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping
        ]);
    }

    public function addProduct(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer'
        ]);

        $this->cartAccess->addProductToCart($request->product_id, $request->quantity);

        return response()->json();
    }

    public function updateRow(Request $request, $rowid)
    {
        $this->validate($request, [
            'quantity' => 'required|integer|min:1'
        ]);

        if(! $this->cartAccess->hasRow($rowid)) {
            return response()->json(['message' => 'invalid row id'], 404);
        }

        $this->cartAccess->updateRow($rowid, $request->quantity);
        return response()->json();
    }

    public function removeRow($rowid)
    {
        if(! $this->cartAccess->hasRow($rowid)) {
            return response()->json(['message' => 'invalid row id'], 404);
        }

        $this->cartAccess->removeProduct($rowid);

        return response()->json();
    }
}
