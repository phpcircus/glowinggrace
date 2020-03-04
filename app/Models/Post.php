<?php

namespace App\Models;

use Illuminate\Support\Str;
use Wink\WinkPost;

class Post extends WinkPost
{
    /** @var array */
    protected $appends = [
        'readable_publish_date',
        'excerpt',
    ];

    /**
     * Get a human readable version of publish date.
     */
    public function getReadablePublishDateAttribute(): string
    {
        return $this->publish_date->diffForHumans();
    }

    /**
     * Get a the excerpt attribute for the post.
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit($this->attributes['excerpt'], 400);
    }
}
