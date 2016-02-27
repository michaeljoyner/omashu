<?php

namespace Omashu\Listeners;

use Omashu\Events\OrderWasPlaced;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Omashu\Mailing\AdminMailer;

class NotifyOfNewOrder
{
    /**
     * @var AdminMailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param AdminMailer $mailer
     */
    public function __construct(AdminMailer $mailer)
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
        $this->mailer->notifyOfNewOrder($event->order);
    }
}
