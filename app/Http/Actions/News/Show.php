<?php

namespace App\Http\Actions\News;

use App\Http\Responders\News\ShowResponder;
use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Show extends Action
{
    /** @var \App\Http\Responders\News\ShowResponder **/
    private $responder;

    /**
     * Construct a new Show.
     *
     * @param  \App\Http\Responders\News\ShowResponder  $responder
     */
    public function __construct(ShowResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     */
    public function __invoke(Request $request, News $news): Response
    {
        return $this->responder->withPayload($news->load('author'))->respond();
    }
}
