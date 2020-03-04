<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Arr;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class StoreUserService extends Service
{
    use SelfCallingService;

    /** @var \App\Services\StoreUserValidation */
    private $validator;

    /** @var \App\Models\User */
    private $users;

    /**
     * Construct a new StoreUserService.
     *
     * @param  \App\Services\StoreUserValidation  $validator
     * @param  \App\Models\User  $users
     */
    public function __construct(StoreUserValidation $validator, User $users)
    {
        $this->validator = $validator;
        $this->users = $users;
    }

    /**
     * Handle the call to the service.
     *
     * @param  array  $parameters
     *
     * @return \App\Models\User
     */
    public function run(array $parameters)
    {
        return $this->users->createUser(Arr::only($parameters, ['id', 'name', 'email', 'password', 'is_admin']));
    }
}
