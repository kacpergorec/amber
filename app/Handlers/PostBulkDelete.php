<?php
declare (strict_types=1);

namespace App\Handlers;

use App\Models\Post;
use Symfony\Component\Uid\Uuid;

final class PostBulkDelete
{
    /**
     * @param Uuid[] $uuids
     */
    public function handle(array $uuids): void
    {
        try {
            Post::whereIn('id', $uuids)->delete();
        } catch (\Throwable $e) {
            \Log::error('Post deletion error:', ['exception' => $e]);
            throw $e;
        }
    }
}
