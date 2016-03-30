<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/25/16
 * Time: 10:58 AM
 */

namespace Omashu\Mailing;


class CustomerMailer extends Mailer
{

    public function sendOrderConfirmation($order)
    {
        $to = [$order->email => $order->name];
        $from = ['orders@omashuimports.com' => 'Omashu Imports'];
        $subject = 'Omashu Imports 訂單確認通知';
        $view = 'emails.orders.confirm';
        $data = [
            'customer_name' => $order->name,
            'items' => $order->items->toArray(),
            'order_total' => $order->total_price,
            'del_address' => $order->address,
            'shipping_fee' => $order->shipping_fee,
            'order_number' => $order->order_number
        ];

        $this->sendTo($to, $from, $subject, $view, $data);
    }

}