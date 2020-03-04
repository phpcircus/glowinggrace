<?php

namespace App\Http\Responders\Post;

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
        return Inertia::render('Posts/Index', [
            'posts' => $this->payload,
        ]);
    }
}
