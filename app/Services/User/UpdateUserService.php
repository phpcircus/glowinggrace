<?php

namespace App\Services\User;

use Illuminate\Support\Arr;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class UpdateUserService extends Service
{
    use SelfCallingService;

    /** @var \App\Services\User\UpdateUserValidation */
    private $validator;

    /**
     * Construct a new UpdateUserService.
     *
     * @param  \App\Services\User\UpdateUserValidation  $validator
     */
    public function __construct(UpdateUserValidation $validator)
    {
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
        return $this->getSupplementals('user')->updateUserData(Arr::only($parameters, ['name', 'email']));
    }
}
