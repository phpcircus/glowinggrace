<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    /**
     * A Customer has many Purchases.
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Create a new customer.
     *
     * @param  array  $attributes
     */
    public function createCustomer(array $attributes): Customer
    {
        return $this->firstOrCreate([
            'email' => $attributes['email']
        ], [
            'name' => $attributes['name'],
            'phone' => $attributes['phone'],
        ]);
    }
}
