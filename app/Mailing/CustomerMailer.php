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
        $subject = 'Thank you for your order!';
        $view = 'emails.orders.confirm';
        $data = [
            'customer_name' => $order->name,
            'items' => $order->items->toArray(),
            'order_total' => $order->total_price
        ];

        $this->sendTo($to, $from, $subject, $view, $data);
    }

}