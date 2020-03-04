<?php

namespace App\Http\Responders\Home;

use Inertia\Inertia;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class IndexResponder extends Responder
{
    /**
     * Send a response.
     */
    public function respond(): Response
    {
        return Inertia::render('Dashboard/Index');
        // return redirect()->route('wink.spa');
    }
}
