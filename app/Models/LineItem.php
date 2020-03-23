<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LineItem extends Model
{
    /**
     * A LineItem belongs to a size.
     */
    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    /**
     * A LineItem belongs to a Purchase.
     */
    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }
}
