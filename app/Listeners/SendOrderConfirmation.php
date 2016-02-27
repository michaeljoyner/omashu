<?php

namespace Omashu\Listeners;

use Omashu\Events\OrderWasPlaced;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Omashu\Mailing\CustomerMailer;

class SendOrderConfirmation
{
    /**
     * @var CustomerMailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param CustomerMailer $mailer
     */
    public function __construct(CustomerMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  OrderWasPlaced  $event
     * @return void
     */
    public function handle(OrderWasPlaced $event)
    {
        $this->mailer->sendOrderConfirmation($event->order);
    }
}
