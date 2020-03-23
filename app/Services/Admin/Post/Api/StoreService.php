<?php

namespace App\Services\Admin\Post\Api;

use App\Models\Post;
use App\Services\Admin\Post\Api\StoreValidationService;
use Illuminate\Support\Str;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;
use Wink\WinkTag;

class StoreService extends Service
{
    use SelfCallingService;

    /** @var \App\Models\Post */
    private $posts;

    /** @var \App\Services\Admin\Post\Api\StoreValidationService */
    protected $validator;

    /**
     * Construct a new StoreService.
     *
     * @param  \Wink\Post  $posts
     * @param  \App\Services\Admin\Post\Api\StoreValidationService  $validator
     */
    public function __construct(Post $posts, StoreValidationService $validator)
    {
        $this->posts = $posts;
        $this->validator = $validator;
    }

    /**
     * Handle the call to the service.
     *
     * @param  array  $parameters
     *
     * @return mixed
     */
    public function run(array $parameters = [])
    {
        $entry = $this->post_id !== 'new' ? $this->posts->findOrFail($this->post_id) : $this->posts->make(['id' => $parameters['id']]);
        $entry->fill($parameters);
        $entry->save();

        if ($tags = $this->tags) {
            $entry->tags()->sync(
                $this->collectTags($tags)
            );
        }
    }

    /**
     * Tags incoming from the request.
     *
     * @param  array  $incomingTags
     * @return array
     */
    private function collectTags($incomingTags)
    {
        $allTags = WinkTag::all();

        return collect($incomingTags)->map(function ($incomingTag) use ($allTags) {
            $tag = $allTags->where('slug', Str::slug($incomingTag['name']))->first();

            if (! $tag) {
                $tag = WinkTag::create([
                    'id' => $id = Str::uuid(),
                    'name' => $incomingTag['name'],
                    'slug' => Str::slug($incomingTag['name']),
                ]);
            }

            return (string) $tag->id;
        })->toArray();
    }
}
