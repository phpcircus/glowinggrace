<?php

namespace App\Models\Builders\Purchase;

trait PurchaseBuilderScopes
{
    /**
     * Scope the query to purchases that were successful.
     */
    public function successful(): PurchaseQueryBuilder
    {
        return $this->where('purchase_success', '=', true);
    }

    /**
     * Scope the query to purchases that were successful.
     *
     * @param  bool  $onlyNotDelivered
     */
    public function notDelivered(bool $onlyNotDelivered): PurchaseQueryBuilder
    {
        return $onlyNotDelivered ? $this->where('delivered', '=', false) : $this;
    }
}
