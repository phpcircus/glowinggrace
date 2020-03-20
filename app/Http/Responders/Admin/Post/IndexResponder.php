<?php

namespace App\Http\Responders\Admin\Post;

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
        return Inertia::render('Wink/screens/posts/Index', [
            'posts' => $this->payload,
        ]);
    }
}
