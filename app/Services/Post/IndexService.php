<?php

namespace App\Services\Post;

use App\Models\Post;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class IndexService extends Service
{
    use SelfCallingService;

    /** @var \App\Models\Post */
    private $posts;

    /**
     * Construct a new IndexService.
     *
     * @param  \App\Models\Post  $posts
     */
    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Handle the call to the service.
     *
     * @param  array  $parameters
     */
    public function run(array $parameters = []): array
    {
        return $this->posts->with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC')
            ->get()
            ->paginate(4);
    }
}
