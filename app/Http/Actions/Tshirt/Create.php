<?php

namespace App\Http\Actions\Tshirt;

use App\Http\Responders\Tshirt\CreateResponder;
use Illuminate\Http\Request;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Create extends Action
{
    /** @var \App\Http\Responders\Tshirt\CreateResponder */
    private $responder;

    /**
     * Construct a new Tshirt Create action.
     *
     * @param  \App\Http\Responders\Tshirt\CreateResponder  $responder
     */
    public function __construct(CreateResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     *  @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request): Response
    {
        return $this->responder->respond();
    }
}
