<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/28/15
 * Time: 7:19 PM
 */

namespace Omashu\Mailing;


class AdminMailer extends Mailer {

    public function sendSiteMessage($name, $from, $site_message)
    {
        $to = ['ian@omashuimports.com' => 'Ian Brown', 'krissy@omashuimports.com' => 'Krissy'];
        $view = 'emails.sitemessage';
        $data = [
            'name' => $name,
            'site_message' => $site_message
        ];
        $subject = "Omashu site message from ".$name;
        $this->sendTo($to, $from, $subject, $view, $data);
    }

    public function notifyOfNewOrder($order)
    {
//        $to = ['ian@omashuimports.com' => 'Ian Brown', 'krissy@omashuimports.com' => 'Krissy'];
        $to = ['joyner.michael@gmail.com' => 'Michael Joyner'];
        $from = [$order->email => $order->name];
        $subject = 'New Omashu Online Order Placed #'.$order->order_number;
        $view = 'emails.orders.notify';
        $data = [
            'customer_name' => $order->name,
            'customer_email' => $order->email,
            'customer_phone' => $order->phone,
            'items' => $order->items->toArray(),
            'customer_query' => $order->customer_query,
            'address' => $order->address,
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'order_total' => $order->total_price
        ];

        $this->sendTo($to, $from, $subject, $view, $data);
    }

}