<?php

namespace App\Http\Responders\News;

use Illuminate\Http\RedirectResponse;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class StoreResponder extends Responder
{
    /**
     * Send a response.
     */
    public function respond(): RedirectResponse
    {
        flash('success', 'News item created successfully!');

        return redirect()->route('posts.home');
    }
}
