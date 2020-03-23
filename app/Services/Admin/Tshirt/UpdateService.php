<?php

namespace App\Services\Admin\Tshirt;

use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class UpdateService extends Service
{
    use SelfCallingService;

    /**
     * Handle the call to the service.
     *
     * @param  array  $parameters
     *
     * @return mixed
     */
    public function run(array $parameters = [])
    {
        return $this->purchase->update($parameters);
    }
}
