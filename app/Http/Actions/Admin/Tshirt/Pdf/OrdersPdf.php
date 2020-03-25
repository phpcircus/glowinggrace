<?php

namespace App\Http\Actions\Admin\Tshirt\Pdf;

use App\Http\Responders\Admin\Tshirt\Pdf\OrdersPdfResponder;
use App\Models\Purchase;
use Illuminate\Http\Request;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class OrdersPdf extends Action
{
    /** @var \App\Http\Responders\Admin\Tshirt\Pdf\OrdersPdfResponder */
    private $responder;

    /** @var \App\Models\Purchase */
    private $purchases;

    /**
     * Construct a new OrdersPdf action.
     *
     * @param  \App\Http\Responders\Admin\Tshirt\Pdf\OrdersPdfResponder  $responder
     * @param  \App\Models\Purchase  $purchases
     */
    public function __construct(OrdersPdfResponder $responder, Purchase $purchases)
    {
        $this->responder = $responder;
        $this->purchases = $purchases;
    }

    /**
     * Execute the action.
     *
     *  @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request)
    {
        $orders = $request->input('q') === 'all'
            ? $this->purchases->successful()->with('customer', 'lineItems.size')->get()
            : $this->purchases->successful()->notDelivered()->with('customer', 'lineItems.size')->get();

        return $this->responder->withPayload(['orders' => $orders])->respond();
    }
}
