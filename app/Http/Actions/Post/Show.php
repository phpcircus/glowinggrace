<?php

namespace App\Http\Actions\Post;

use App\Http\Responders\Post\ShowResponder;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Show extends Action
{
    /** @var \App\Http\Responders\Post\ShowResponder **/
    private $responder;

    /**
     * Construct a new Show.
     *
     * @param  \App\Http\Responders\Post\ShowResponder  $responder
     */
    public function __construct(ShowResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     */
    public function __invoke(Request $request, Post $post):Response
    {
        return $this->responder->withPayload($post->load('author'))->respond();
    }
}
