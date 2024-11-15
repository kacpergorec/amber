<?php

namespace App\Livewire;

use App\Enums\PostBulkActionType;
use App\Handlers\PostBulkOperator;
use App\Handlers\PostDelete;
use App\Livewire\Traits\WithBulkSelection;
use App\Livewire\Traits\WithPaginationSize;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PostTable extends Component
{
    use WithPagination;
    use WithPaginationSize;
    use WithBulkSelection;

    public function mount(): void
    {
        $this->initializePaginationSize();
    }

    public function deletePostConfirm(Post $post, PostDelete $delete): void
    {
        $delete->handle($post);
        $this->dispatch('notify', 'success', 'Post deleted successfully');
    }

    public function selectAll(?int $currentPage = null): void
    {
        $this->bulkSelectAll(Post::class, $currentPage);
        $message = $this->bulkMessage('post', 'selected');
        $this->dispatch('notify', 'info', $message);
    }

    public function tableSelectionAction(PostBulkActionType $type, PostBulkOperator $operator): void
    {
        $message = $this->bulkMessage('post', $type->getVerb());
        $this->bulkHandle($type, $operator);
        $this->dispatch('notify', 'success', $message);
    }

    public function render(): View
    {
        return view('livewire.post-table', [
            'posts' => Post::paginate($this->perPage),
        ]);
    }
}
