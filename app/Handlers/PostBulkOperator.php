<?php
declare (strict_types=1);

namespace App\Handlers;

use App\Enums\BulkActionType;
use App\Factory\PostBulkHandlerFactory;
use Symfony\Component\Uid\Uuid;

final readonly class PostBulkOperator
{
    public function __construct(
        private PostBulkHandlerFactory $handlerFactory,
    )
    {
    }

    /**
     * @param Uuid[] $uuids
     */
    public function handle(array $uuids, BulkActionType $type): void
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
