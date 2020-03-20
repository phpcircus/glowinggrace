<?php

namespace App\Http\Responders\Tshirt;

use Illuminate\Http\RedirectResponse;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class ShowResponder extends Responder
{
    /**
     * Send a response.
     */
    public function respond(): RedirectResponse
    {
        return redirect('https://docs.google.com/forms/d/1aZgaBNXgSH-9zanv6nFpVplVvTp7jxjkfcqQB31Fg28/viewform');
    }
}
