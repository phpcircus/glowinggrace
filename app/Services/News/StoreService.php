<?php

namespace App\Services\News;

use App\Models\News;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class StoreService extends Service
{
    use SelfCallingService;

    private News $news;

    /**
     * Construct a new StoreService.
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * Handle the call to the service.
     *
     * @param  array  $parameters
     */
    public function run(array $parameters = []): News
    {
        return $this->news->createNews($parameters['title'], $parameters['body'], $this->author_id);
    }
}
