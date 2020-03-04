<?php

namespace App\Http\Actions\Auth\Login;

use Inertia\Inertia;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class ShowForm extends Action
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return Inertia::render('Auth/Login');
    }
}
