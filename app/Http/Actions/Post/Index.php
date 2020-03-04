<?php

namespace App\Http\Actions\Post;

use App\Http\Responders\Post\IndexResponder;
use App\Services\Post\IndexService;
use Illuminate\Http\Request;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Index extends Action
{
    /** @var \App\Http\Responders\Post\IndexResponder **/
    private $responder;

    /**
     * Construct a new Index.
     *
     * @param  \App\Http\Responders\Post\IndexResponder  $responder
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
