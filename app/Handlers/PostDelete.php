<?php
declare (strict_types=1);

namespace App\Handlers;

use App\Models\Post;

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
