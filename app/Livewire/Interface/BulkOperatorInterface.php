<?php
declare (strict_types=1);

namespace App\Livewire\Interface;

use Symfony\Component\Uid\Uuid;

interface BulkOperatorInterface
{
    /**
     * @param Uuid[] $uuids
     */
    public function handle(array $uuids, BulkActionTypeInterface $type): void;
}
