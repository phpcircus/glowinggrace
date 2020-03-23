<?php

namespace App\Http\Actions\Admin\Tshirt;

use App\Http\Responders\Admin\Tshirt\ShowResponder;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Show extends Action
{
    /** @var \App\Http\Responders\Admin\Tshirt\ShowResponder */
    private $responder;

    /**
    * Construct a new Tshirt Show action.
    *
    * @param  \App\Http\Responders\Admin\Tshirt\ShowResponder  $responder
    */
    public function __construct(ShowResponder $responder)
    {
        $this->responder = $responder;
    }
    /**
     * Execute the action.
     *
     *  @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase
     */
    public function __invoke(Request $request, Purchase $purchase): Response
    {
        return $this->responder->withPayload($purchase->load(['customer', 'lineItems.size']))->respond();
    }
}
