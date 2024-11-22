<?php
declare (strict_types=1);

namespace App\Livewire\Table\Traits;

use Livewire\Features\SupportPagination\HandlesPagination;

trait WithPaginationSize
{
    use HandlesPagination;

    public int $perPage = 10;

    public function initializePaginationSize(): void
    {
        $this->perPage = (int) request()->query('per_page', '10');
    }

    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
        $this->resetPage();
    }
}
