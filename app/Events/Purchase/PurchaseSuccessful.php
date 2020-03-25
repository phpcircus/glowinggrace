<?php

namespace App\Events\Purchase;

use App\Models\Purchase;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PurchaseSuccessful
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\Purchase */
    public $purchase;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Purchase  $purchase
     */
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }
}
