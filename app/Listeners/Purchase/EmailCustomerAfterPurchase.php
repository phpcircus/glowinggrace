<?php

namespace App\Listeners\Purchase;

use App\Events\Purchase\PurchaseSuccessful;
use App\Notifications\Purchase\PurchaseSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailCustomerAfterPurchase implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'main';

    /**
     * Handle the event.
     *
     * @param  \App\Events\Purchase\PurchaseSuccessful  $event
     */
    public function handle(PurchaseSuccessful $event): void
    {
        $event->purchase->customer->notify(new PurchaseSuccess($event->purchase));
    }
}
