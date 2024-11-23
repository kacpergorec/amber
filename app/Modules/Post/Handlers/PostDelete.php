<?php
declare (strict_types=1);

namespace App\Modules\Post\Handlers;

use App\Modules\Post\Models\Post;

class PostDelete
{
    public function handle(Post $post): void
    {
        try {
            $post->delete();
        } catch (\Throwable $e) {
            \Log::error('Post deletion error:', ['exception' => $e]);
            throw $e;
        }
    }
}
