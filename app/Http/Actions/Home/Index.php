<?php

namespace App\Http\Actions\Home;

use App\Http\Responders\Home\IndexResponder;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Index extends Action
{
    /** @var \App\Http\Responders\Home\IndexResponder */
    private $responder;

    /**
     * Construct a new Home Index action.
     *
     * @param  \App\Http\Responders\Home\IndexResponder  $responder
     */
    public function __construct(IndexResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Show the application home page.
     */
    public function __invoke(): Response
    {
        return $this->responder->respond();
    }
}
