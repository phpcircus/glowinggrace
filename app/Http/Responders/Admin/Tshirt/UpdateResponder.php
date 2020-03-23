<?php

namespace App\Http\Responders\Admin\Tshirt;

use Illuminate\Http\RedirectResponse;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class UpdateResponder extends Responder
{
    /**
     * Send a response.
     */
    public function respond(): RedirectResponse
    {
        flash('success', 'Order successfully updated!');

        return redirect()->back();
    }
}
