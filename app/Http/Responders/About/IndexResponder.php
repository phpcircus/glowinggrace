<?php

namespace App\Http\Responders\About;

use Inertia\Inertia;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class IndexResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return \Illuminate\View\View
     */
    public function respond()
    {
        return Inertia::render('About/Index');
    }
}
