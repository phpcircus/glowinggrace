<?php

namespace App\Models\Builders\Purchase;

use Illuminate\Database\Eloquent\Builder;

class PurchaseQueryBuilder extends Builder
{
    use PurchaseBuilderScopes;
}
