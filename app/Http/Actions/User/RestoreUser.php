<?php

namespace App\Http\Actions\User;

use App\Http\Actions\Action;
use App\Http\Responders\User\RestoreUserResponder;
use App\Models\User;
use App\Services\User\RestoreUserService;

class RestoreUser extends Action
{
    /** @var \App\Http\Responders\User\RestoreUserResponder */
    private $responder;

    /**
     * Construct a new RestoreUser action.
     *
     * @param  \App\Http\Responders\User\RestoreUserResponder  $responder
     */
    public function __construct(RestoreUserResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Restore a deleted user.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user)
    {
        $restored = RestoreUserService::call($this->forService($user, 'user'));

        return $this->responder->withPayload($restored)->respond();
    }
}
