<?php
declare (strict_types=1);

namespace App\Factory;

use App\Enums\BulkActionType;
use App\Handlers\PostBulkDelete;
use Nette\NotImplementedException;

final readonly class PostBulkHandlerFactory
{
    public function __construct(
     private PostBulkDelete $postBulkDelete
    )
    {
    }

    public function from(BulkActionType $type) // : BulkHandlerInterface
    {
        return match ($type) {
            BulkActionType::DELETE => $this->postBulkDelete,
            BulkActionType::PUBLISH => throw new NotImplementedException('Publish bulk handler not implemented'),
            default => throw new \InvalidArgumentException('Unsupported bulk action type: ' . $type->value),
        };
    }
}
