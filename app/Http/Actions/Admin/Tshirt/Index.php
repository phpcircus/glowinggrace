<?php

namespace App\Http\Actions\Admin\Tshirt;

use App\Http\Responders\Admin\Tshirt\IndexResponder;
use App\Services\Admin\Tshirt\IndexService;
use Illuminate\Http\Request;
use Inertia\Response;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Index extends Action
{
    /** @var \App\Http\Responders\Admin\Tshirt\IndexResponder **/
    private $responder;

    /**
     * Construct a new Index.
     *
     * @param  \App\Http\Responders\Admin\Tshirt\IndexResponder  $responder
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
        $purchases = IndexService::call();

        return $this->responder->withPayload($purchases)->respond();
    }
}
