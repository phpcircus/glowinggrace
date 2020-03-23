<?php

namespace App\Services\Admin\Tshirt;

use App\Models\Purchase;
use PerfectOblivion\ActionServiceResponder\Services\Service;
use PerfectOblivion\ActionServiceResponder\Services\Traits\SelfCallingService;

class IndexService extends Service
{
    use SelfCallingService;

    /** @var \App\Models\Purchase */
    private $purchases;

    /**
     * Construct a new IndexService.
     *
     * @param  \App\Models\Purchase  $purchases
     */
    public function __construct(Purchase $purchases)
    {
        $this->purchases = $purchases;
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
        return $this->purchases->successful()->with('customer', 'lineItems.size')->get();
    }
}
