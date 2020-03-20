<?php

namespace App\Services\Admin\Post;

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
     *
     * @return mixed
     */
    public function run(array $parameters = [])
    {
        return $this->posts->all();
    }
}
