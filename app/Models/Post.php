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
        'limited_excerpt',
    ];

    /** @var array */
    protected $attributes = [
        'excerpt' => 'Post by Kimberlyn Stone',
        'featured_image_caption' => 'caption',
    ];

    /**
     * Set the excerpt attribute for the post.
     *
     * @param string|null $value
     */
    public function setExcerptAttribute($value): string
    {
        if (! $value) {
            return 'Post by Kimberlyn Stone';
        }

        return $value;
    }

    /**
     * Set the featured_image_caption attribute for the post.
     *
     * @param string|null $value
     */
    public function setFeaturedImageCaptionAttribute($value): string
    {
        if (! $value) {
            return 'caption';
        }

        return $value;
    }

    /**
     * Get a human readable version of publish date.
     */
    public function getReadablePublishDateAttribute(): string
    {
        $date = $this->publish_date;

        return $date ? $this->publish_date->diffForHumans() : '';
    }

    /**
     * Get a the excerpt attribute for the post.
     */
    public function getExcerptAttribute(): string
    {
        return isset($this->attributes['excerpt']) ? Str::limit($this->attributes['excerpt'], 400) : '';
    }

    /**
     * Get a the excerpt attribute for the post.
     */
    public function getLimitedExcerptAttribute(): string
    {
        return isset($this->attributes['excerpt']) ? Str::limit($this->attributes['excerpt'], 60) : '';
    }
}
