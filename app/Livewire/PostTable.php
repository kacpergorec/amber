<?php

namespace App\Livewire;

use App\Enums\PostBulkActionType;
use App\Handlers\PostBulkOperator;
use App\Handlers\PostDelete;
use App\Livewire\Traits\WithBulkSelection;
use App\Livewire\Traits\WithPaginationSize;
use App\Livewire\Traits\WithSortableColumns;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class PostTable extends Component
{
    // Todo: reconsider one Table Trait
    use WithPagination;
    use WithPaginationSize;
    use WithBulkSelection;
    use WithSortableColumns;

    use AuthorizesRequests;

    public function mount(): void
    {
        $this->initializePaginationSize();
    }

    public function deletePostConfirm(Post $post, PostDelete $delete): void
    {
        $delete->handle($post);
        $this->selectedItems = [];
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
        $posts = Post::with('author')
            ->leftJoin('users as author', 'posts.author_id', '=', 'author.id')
            ->orderBy('author.name', $this->sortDirection)
            ->select('posts.*')
            ->paginate($this->perPage);

        return view('livewire.post-table', [
            'posts' => $posts,
        ]);
    }
}
