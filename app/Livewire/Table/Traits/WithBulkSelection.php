<?php
declare (strict_types=1);

namespace App\Livewire\Table\Traits;

use App\Livewire\Table\Interface\BulkActionTypeInterface;
use App\Livewire\Table\Interface\BulkOperatorInterface;
use App\Models\Post;
use Symfony\Component\Uid\Uuid;

trait WithBulkSelection
{
    /** @var Uuid[] $selectedItems */
    public array $selectedItems = [];

    private function bulkSelectAll(string $class, ?int $currentPage = null): void
    {
        /** @var string $table */
        $table = (new $class)->getTable();

        if (!\Schema::hasColumn($table, 'id')) {
            throw new \LogicException("Table $table does not have an id column, needed for bulk selection");
        }

        if ($currentPage) {
            $data = Post::with('author')
                ->leftJoin('users as author', 'posts.author_id', '=', 'author.id')
                ->orderBy($this->sortField, $this->sortDirection)
                ->orderBy('posts.id')
                ->select('posts.*')
                ->paginate($this->perPage)
            ;
        } else {
            $data = \DB::table($table)->get();
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

    public function bulkMessage(string $name = 'item', string $verb = 'handled') : string
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
