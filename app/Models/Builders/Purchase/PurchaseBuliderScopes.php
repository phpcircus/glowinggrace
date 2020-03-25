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
     * Scope the query to purchases that have been delivered.
     */
    public function delivered(): PurchaseQueryBuilder
    {
        return $this->where('delivered', '=', true);
    }

    /**
     * Scope the query to purchases that have been delivered.
     */
    public function notDelivered(): PurchaseQueryBuilder
    {
        return $this->where('delivered', '=', false);
    }
}
