<?php

namespace App\Http\Responders\Tshirt;

use Inertia\Inertia;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class CreateResponder extends Responder
{
    /**
     * Send a response.
     */
    public function respond(): Response
    {
        return Inertia::render('Tshirt/Create');
    }
}
