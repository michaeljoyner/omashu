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

}