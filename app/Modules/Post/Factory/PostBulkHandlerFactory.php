<?php
declare (strict_types=1);

namespace App\Modules\Post\Factory;

use App\Livewire\Table\Interface\BulkActionTypeInterface;
use App\Modules\Post\Enums\PostBulkActionType;
use App\Modules\Post\Handlers\PostBulkDelete;
use Nette\NotImplementedException;

final readonly class PostBulkHandlerFactory
{
    public function __construct(
     private PostBulkDelete $postBulkDelete
    )
    {
    }

    public function from(BulkActionTypeInterface $type) // TODO: BulkHandlerInterface
    {
        return match ($type) {
            PostBulkActionType::DELETE => $this->postBulkDelete,
            PostBulkActionType::PUBLISH => throw new NotImplementedException('Publish bulk handler not implemented'),
            default => throw new \InvalidArgumentException('Unsupported bulk action type: ' . $type->value),
        };
    }
}
