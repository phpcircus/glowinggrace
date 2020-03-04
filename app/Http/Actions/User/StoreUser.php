<?php

namespace App\Http\Actions\User;

use App\Http\Actions\Action;
use App\Http\Responders\User\StoreUserResponder;
use App\Services\User\StoreUserService;
use Illuminate\Http\Request;

class StoreUser extends Action
{
    /** @var \App\Http\Responders\User\StoreUserResponder */
    private $responder;

    /**
     * Construct a new StoreUser action.
     *
     * @param  \App\Http\Responders\User\StoreUserResponder  $responder
     */
    public function __construct(StoreUserResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Store a mew user from the provided data.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illluminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $created = StoreUserService::call($request->all());

        return $this->responder->withPayload($created)->respond();
    }
}
