<?php

namespace App\Http\Responders\User;

use Inertia\Inertia;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class CreateUserResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return \Illuminate\View\View
     */
    public function respond()
    {
        return Inertia::render('Users/Create');
    }
}
