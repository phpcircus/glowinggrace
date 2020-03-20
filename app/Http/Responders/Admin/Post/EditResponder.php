<?php

namespace App\Http\Responders\Admin\Post;

use App\Models\Post;
use Illuminate\Support\Str;
use Inertia\Inertia;
use PerfectOblivion\ActionServiceResponder\Responders\Responder;

class EditResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return mixed
     */
    public function respond()
    {
        $tempId = Str::uuid();

        return Inertia::render('Wink/screens/posts/Edit', [
            'entry' => $this->payload ?? Post::make(['id' => $tempId, 'publish_date' => now()->format('Y-m-d H:i:00'), 'meta' => []]),
            'id' => $this->payload ? $this->payload->id : 'new',
        ]);
    }
}
