<?php

namespace App\Http\Responders\Admin\Tshirt;

use Inertia\Inertia;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class ShowResponder extends Responder
{
    /**
     * Send a response.
     */
    public function respond(): Response
    {
        return Inertia::render('Tshirt/Show', [
            'order' => $this->payload,
        ]);
    }
}
