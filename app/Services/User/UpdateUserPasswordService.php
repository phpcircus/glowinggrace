<?php

namespace App\Services\User;

use Illuminate\Support\Arr;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class UpdateUserPasswordService extends Service
{
    use SelfCallingService;

    /** @var \App\Services\User\UpdateUserPasswordValidation */
    private $validator;

    /**
     * Construct a new UpdateUserPasswordService.
     *
     * @param  \App\Services\User\UpdateUserPasswordValidation
     */
    public function __construct(UpdateUserPasswordValidation $validator)
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
        return $this->getSupplementals('user')->updateUserPassword(Arr::only($parameters, ['password']));
    }
}
