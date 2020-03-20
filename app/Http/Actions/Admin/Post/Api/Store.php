<?php

namespace App\Http\Actions\Admin\Post\Api;

use App\Http\Responders\Admin\Post\Api\StoreResponder;
use App\Services\Admin\Post\Api\StoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PerfectOblivion\ActionServiceResponder\Actions\Action;

class Store extends Action
{
    /** @var \App\Http\Responders\Admin\Post\StoreResponder * */
    private $responder;

    /**
     * Construct a new Store.
     *
     * @param  \App\Http\Responders\Admin\Post\StoreResponder  $responder
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
    public function __invoke(Request $request): JsonResponse
    {
        StoreService::call(Arr::only($request->input('form'), [
            'id',
            'title',
            'excerpt',
            'slug',
            'body',
            'published',
            'author_id',
            'featured_image',
            'featured_image_caption',
            'publish_date',
            'meta',
        ]), [
            'post_id' => $request->input('id'),
            'tags' => $request->input('form')['tags'],
        ]);

        return $this->responder->respond();
    }
}
