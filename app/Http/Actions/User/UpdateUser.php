<?php

namespace App\Http\Actions\User;

use App\Http\Actions\Action;
use App\Http\Responders\User\UpdateUserResponder;
use App\Models\User;
use App\Services\User\UpdateUserService;
use App\Services\User\UpdateUserPasswordService;
use Illuminate\Http\Request;

class UpdateUser extends Action
{
    /** @var \App\Http\Responders\User\UpdateUserResponder */
    private $responder;

    /**
     * Construct a new UpdateUser action.
     *
     * @param  \App\Http\Responders\User\UpdateUserResponder  $responder
     */
    public function __construct(UpdateUserResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Update a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user  Passed to Service as supplemental data behind the scenes
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request, User $user)
    {
        $updated = UpdateUserService::call($request->only(['id', 'name', 'email']));

        if ($request->password) {
            UpdateUserPasswordService::call($request->only(['password']));
        }

        return $this->responder->withPayload($updated)->respond();
    }
}
