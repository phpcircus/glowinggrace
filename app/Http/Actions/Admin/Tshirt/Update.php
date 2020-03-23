<?php

namespace App\Http\Actions\Admin\Tshirt;

use App\Http\Responders\Admin\Tshirt\UpdateResponder;
use App\Models\Purchase;
use App\Services\Admin\Tshirt\UpdateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Update extends Action
{
    /** @var \App\Http\Responders\Admin\Tshirt\UpdateResponder **/
    private $responder;

    /**
     * Construct a new Update.
     *
     * @param  \App\Http\Responders\Admin\Tshirt\UpdateResponder  $responder
     */
    public function __construct(UpdateResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     */
    public function __invoke(Request $request, Purchase $purchase): RedirectResponse
    {
        UpdateService::call($request->only(['delivered']));

        return $this->responder->respond();
    }
}
