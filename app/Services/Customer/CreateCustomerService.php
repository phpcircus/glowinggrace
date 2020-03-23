<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Services\Customer\CreateCustomerValidationService;
use Illuminate\Support\Arr;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class CreateCustomerService extends Service
{
    use SelfCallingService;

    /** @var \App\Services\Customer\CreateCustomerValidationService */
    protected $validator;

    /** @var \App\Models\Customer */
    private $customers;

    /**
     * Construct a new CreateCustomerService.
     *
     * @param  \App\Services\Customer\CreateCustomerValidationService
     * @param  \App\Models\Customer  $customers
     */
    public function __construct(CreateCustomerValidationService $validator, Customer $customers)
    {
        $this->validator = $validator;
        $this->customers = $customers;
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
        return $this->customers->createCustomer(Arr::only($parameters, [
            'name',
            'email',
            'phone',
        ]));
    }
}
