<?php

namespace Omashu\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Omashu\Http\Requests;
use Omashu\Http\Controllers\Controller;
use Omashu\Orders\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(15);
        $status = 'all';

        return view('admin.orders.index')->with(compact('orders', 'status'));
    }

    public function filterByStatus($status)
    {
        $orders = $this->getOrdersForStatus($status);

        return view('admin.orders.index')->with(compact('orders', 'status'));
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);

        return view('admin.orders.show')->with(compact('order'));
    }

    public function cancelledStatus(Request $request, $id)
    {
        return $this->toggleOrderState('cancel', 'setCancelledStatus', $request, $id);
    }

    public function paidStatus(Request $request, $id)
    {
        return $this->toggleOrderState('pay', 'setPaidStatus', $request, $id);
    }

    public function shippedStatus(Request $request, $id)
    {
        return $this->toggleOrderState('ship', 'setShippedStatus', $request, $id);
    }

    protected function toggleOrderState($attribute, $method, $request, $id)
    {
        $this->validate($request, [$attribute => 'required|boolean']);

        $order = Order::findOrFail($id);
        $new_state = $order->{$method}($request->{$attribute});

        return response()->json(['new_state' => $new_state]);
    }

    public function archive($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        flash()->message('Order has been moved to te archives.');

        return redirect('admin/orders');
    }

    private function getOrdersForStatus($status)
    {
        switch($status) {
            case 'cancelled':
                $orders = Order::where('is_cancelled', 1)->latest()->paginate(15);
                break;
            case 'paid':
                $orders = Order::where('is_paid', 1)->where('is_shipped', 0)->latest()->paginate(15);
                break;
            case 'shipped':
                $orders = Order::where('is_paid', 0)->where('is_shipped', 1)->latest()->paginate(15);
                break;
            case 'complete':
                $orders = Order::where('is_paid', 1)->where('is_shipped', 1)->latest()->paginate(15);
                break;
            case 'open':
                $orders = Order::where('is_paid', 0)->where('is_shipped', 0)->where('is_cancelled', 0)->latest()->paginate(15);
                break;
            default:
                $orders = Order::latest()->paginate(15);
        }

        return $orders;

    }
}
