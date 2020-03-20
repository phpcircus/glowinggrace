<?php

namespace App\Services\Admin\Post\Api;

use Illuminate\Validation\Rule;
use PerfectOblivion\ActionServiceResponder\Validation\ValidationService\ValidationService;

class StoreValidationService extends ValidationService
{
    /**
     * Get the validation rules that apply to the data.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'publish_date' => ['required', 'date'],
            'excerpt' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'string'],
            'featured_image_caption' => ['nullable', 'string'],
            'author_id' => ['required'],
            'title' => ['required'],
            'slug' => ['required', Rule::unique(config('wink.database_connection').'.wink_posts', 'slug')->ignore($this->data['id'])],
        ];
    }

    /**
     * Get the sanitization filters that apply to the data.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'publish_date' => ['trim'],
            'author_id' => ['trim'],
            'title' => ['trim', 'strip_tags'],
            'excerpt' => ['trim', 'strip_tags'],
            'featured_image' => ['trim', 'strip_tags'],
            'featured_image_caption' => ['trim', 'strip_tags'],
            'slug' => ['trim', 'strip_tags'],
        ];
    }
}
