<?php

namespace App\Http\Actions\Admin\Post;

use App\Http\Responders\Admin\Post\IndexResponder;
use App\Services\Admin\Post\IndexService;
use Illuminate\Http\Request;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Index extends Action
{
    /** @var \App\Http\Responders\Admin\Post\IndexResponder */
    private $responder;

    /**
     * Construct a new Post Index action.
     *
     * @param  \App\Http\Responders\Admin\Post\IndexResponder  $responder
     */
    public function __construct(IndexResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     *  @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request): Response
    {
        $posts = IndexService::call();

        return $this->responder->withPayload($posts)->respond();
    }
}
