<?php
declare (strict_types=1);

namespace App\Livewire\Table\Traits;

use App\Livewire\Table\Interface\BulkActionTypeInterface;
use App\Livewire\Table\Interface\BulkOperatorInterface;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Uid\Uuid;

trait WithBulkSelection
{
    /** @var Uuid[] $selectedItems */
    public array $selectedItems = [];

    /**
     * @param int|null $fromPage - Leave null to select all items
     */
    private function bulkSelectAll(Builder $query, ?int $fromPage = null): void
    {
        $data = $query->orderBy($this->sortField, $this->sortDirection);

        if ($fromPage){
            $data = $data->paginate($this->perPage, ['*'], 'page', $fromPage);
        } else {
            $data = $data->get();
        }

        $ids = $data->pluck('id')->toArray();

        $allItemsAreSelected = empty(array_diff($ids, $this->selectedItems));

        if ($allItemsAreSelected) {
            $this->selectedItems = array_diff($this->selectedItems, $ids);
        } else {
            $this->selectedItems = array_merge($this->selectedItems, $ids);
            $this->selectedItems = array_unique($this->selectedItems);
        }

        $this->selectedItems = array_values($this->selectedItems);
    }

    private function bulkHandle(BulkActionTypeInterface $type, BulkOperatorInterface $operator): void
    {
        $operator->handle($this->selectedItems, $type);

        $this->selectedItems = [];
    }

    public function bulkMessage(string $name = 'item', string $verb = 'handled'): string
    {
        if (count($this->selectedItems) === 1) {
            return sprintf(
                '1 %s %s',
                $name,
                $verb,
            );
        }

        return sprintf(
            '%s %ss %s',
            count($this->selectedItems),
            $name,
            $verb,
        );
    }
}
