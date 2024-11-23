<?php
declare (strict_types=1);

namespace App\Modules\Post\Handlers;

use App\Livewire\Table\Interface\BulkActionTypeInterface;
use App\Livewire\Table\Interface\BulkOperatorInterface;
use App\Modules\Post\Factory\PostBulkHandlerFactory;
use Symfony\Component\Uid\Uuid;

final readonly class PostBulkOperator implements BulkOperatorInterface
{
    public function __construct(
        private PostBulkHandlerFactory $handlerFactory,
    )
    {
    }

    /**
     * @param Uuid[] $uuids
     */
    public function handle(array $uuids, BulkActionTypeInterface $type): void
    {
        try {
            if (empty($uuids)) {
                return;
            }

            $handler = $this->handlerFactory->from($type);
            $handler->handle($uuids);
        }catch (\Throwable $e){
            \Log::error('Bulk action error:', ['exception' => $e]);
            throw $e;
        }
    }
}
