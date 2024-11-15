<?php
declare (strict_types=1);

namespace App\Factory;

use App\Enums\PostBulkActionType;
use App\Handlers\PostBulkDelete;
use Nette\NotImplementedException;

final readonly class PostBulkHandlerFactory
{
    public function __construct(
     private PostBulkDelete $postBulkDelete
    )
    {
    }

    public function from(PostBulkActionType $type) // : BulkHandlerInterface
    {
        return match ($type) {
            PostBulkActionType::DELETE => $this->postBulkDelete,
            PostBulkActionType::PUBLISH => throw new NotImplementedException('Publish bulk handler not implemented'),
            default => throw new \InvalidArgumentException('Unsupported bulk action type: ' . $type->value),
        };
    }
}
