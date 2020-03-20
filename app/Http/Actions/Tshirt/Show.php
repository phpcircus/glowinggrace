<?php

namespace App\Http\Actions\Tshirt;

use App\Http\Responders\Tshirt\ShowResponder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Show extends Action
{
    /** @var \App\Http\Responders\Tshirt\ShowResponder */
    private $responder;

    /**
     * Construct a new Tshirt Show action.
     *
     * @param  \App\Http\Responders\Tshirt\ShowResponder  $responder
     */
    public function __construct(ShowResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     *  @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request): RedirectResponse
    {
        return $this->responder->respond();
    }
}
