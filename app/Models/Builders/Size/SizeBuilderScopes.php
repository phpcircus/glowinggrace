<?php

namespace App\Models\Builders\Size;

trait SizeBuilderScopes
{
    /**
     * Scope the query to sizes that are available.
     */
    public function available(): SizeQueryBuilder
    {
        return $this->where('available', '=', true);
    }
}
