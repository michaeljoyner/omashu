<?php

namespace Omashu\Http\Controllers;

use Illuminate\Http\Request;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;
use Omashu\Http\Requests\CheckoutRequest;
use Omashu\Invoicing\InvoiceService;
use Omashu\Orders\OrderService;
use Omashu\Shopping\CartAccess;

class CheckoutController extends Controller
{
    public function checkout(InvoiceService $invoiceService)
    {
        $invoice = $invoiceService->createFromCart(new CartAccess());
        return view('front.pages.checkout')->with(compact('invoice'));
    }

    public function placeOrder(CheckoutRequest $request, OrderService $orderService)
    {
        $order = $orderService->placeOrder($request);
        $order_number = $order->order_number;

        return redirect('thanks')->with('order_number', $order_number);
    }

    public function thanks()
    {
        return view('front.pages.thanks');
    }
}
