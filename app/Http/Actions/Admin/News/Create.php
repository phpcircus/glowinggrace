<?php

namespace App\Http\Actions\Admin\News;

use App\Http\Responders\Admin\News\CreateResponder;
use Illuminate\Http\Request;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Create extends Action
{
    /** @var \App\Http\Responders\Admin\News\CreateResponder * */
    private $responder;

    /**
     * Construct a new Create.
     *
     * @param  \App\Http\Responders\Admin\News\CreateResponder  $responder
     */
    public function __construct(CreateResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request): Response
    {
        return $this->responder->respond();
    }
}
