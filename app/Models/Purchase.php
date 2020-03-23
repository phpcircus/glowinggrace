<?php

namespace App\Models;

use App\Models\Builders\Purchase\PurchaseQueryBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    /** @var array */
    protected $appends = [
        'readable_total',
    ];

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new PurchaseQueryBuilder($query);
    }

    /**
     * A Purchase belongs to a Customer.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * A Purchase has many LineItems.
     */
    public function lineItems(): HasMany
    {
        return $this->hasMany(LineItem::class);
    }

    /**
     * Get the total attribute for a purchase.
     */
    public function getReadableTotalAttribute(): string
    {
        return format_money($this->attributes['total'] / 100);
    }
}
