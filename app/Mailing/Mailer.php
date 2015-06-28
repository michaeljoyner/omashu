<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/28/15
 * Time: 7:17 PM
 */

namespace Omashu\Mailing;

use Illuminate\Contracts\Mail\Mailer as LaravelMailer;

abstract class Mailer {

    /**
     * @var LaravelMailer
     */
    private $laravelMailer;
    public function __construct(LaravelMailer $laravelMailer)
    {
        $this->laravelMailer = $laravelMailer;
    }
    protected function sendTo($to, $from, $subject, $view, $data, $attachments = [])
    {
        $this->laravelMailer->queue($view, $data, function($message) use ($to, $from, $subject, $attachments)
        {
            $message->to($to)->subject($subject);
            foreach($attachments as $filename)
            {
                $message->attach($filename);
            }
            if($from !== '')
            {
                $message->from($from);
            }
        });
    }

}