<?php

namespace App\Http\Actions\Admin\Post;

use App\Http\Responders\Admin\Post\EditResponder;
use App\Models\Post;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Edit extends Action
{
    /** @var \App\Http\Responders\Admin\Post\EditResponder */
    private $responder;

    /**
     * Construct a new Post Edit action.
     *
     * @param  \App\Http\Responders\Admin\Post\EditResponder  $responder
     */
    public function __construct(EditResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @param  \App\Models\Post|null  $post
     */
    public function __invoke(? Post $post = null): Response
    {
        $data = $post ? $post->load(['tags', 'author']) : null;

        return $this->responder->withPayload($data)->respond();
    }
}
