<?php

namespace App\Services\User;

use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class RestoreUserService extends Service
{
    use SelfCallingService;

    /**
     * Handle the call to the service.
     *
     * @param  array  $parameters
     *
     * @return \App\Models\User
     */
    public function run(array $parameters = [])
    {
        return $parameters['user']->restoreUser();
    }
}
