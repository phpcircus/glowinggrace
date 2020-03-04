<?php

namespace App\Services\User;

use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class DeleteUserService extends Service
{
    use SelfCallingService;

    /**
     * Handle the call to the service.
     *
     * @param  array $parameters
     *
     * @return \App\Models\User
     */
    public function run(array $parameters = [])
    {
        return $parameters['user']->deleteUser();
    }
}
