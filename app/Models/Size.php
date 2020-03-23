<?php

namespace App\Models;

use App\Models\Builders\Size\SizeQueryBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new SizeQueryBuilder($query);
    }

    /**
     * A Size has many LineItems.
     */
    public function lineItems(): HasMany
    {
        return $this->hasMany(LineItem::class);
    }
}
