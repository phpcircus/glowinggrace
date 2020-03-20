<?php

namespace App\Http\Actions\Admin\News;

use App\Http\Responders\Admin\News\StoreResponder;
use App\Services\News\StoreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Store extends Action
{
    /** @var \App\Http\Responders\Admin\News\StoreResponder * */
    private $responder;

    /**
     * Construct a new Store.
     *
     * @param  \App\Http\Responders\Admin\News\StoreResponder  $responder
     */
    public function __construct(StoreResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request): RedirectResponse
    {
        StoreService::call($request->only(['title', 'body']), ['author_id' => Auth::guard('wink')->user()->id]);

        return $this->responder->respond();
    }
}
