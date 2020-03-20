<?php

namespace App\Http\Responders\Admin\Post\Api;

use Illuminate\Http\JsonResponse;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class StoreResponder extends Responder
{
    /**
     * Send a response.
     */
    public function respond(): JsonResponse
    {
        return response()->json([
            'status' => 'Post saved!',
        ], 200);
    }
}
