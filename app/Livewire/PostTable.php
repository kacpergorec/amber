<?php

namespace App\Livewire;

use App\Enums\BulkActionType;
use App\Handlers\PostBulkOperator;
use App\Handlers\PostDelete;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\Uid\Uuid;

class PostTable extends Component
{
    //todo add interface, tableSelecion, and paginationSize maybe?

    use WithPagination;

    public $perPage = 10;

    /** @var Uuid[] $selectedPosts */
    public array $selectedPosts = [];

    public function mount(): void
    {
        $this->perPage = request()->query('per_page', 10);
    }

    public function selectAll(?int $currentPage = null): void
    {
        $posts = $currentPage
            ? \DB::table('posts')->paginate($this->perPage, ['id'], 'page', $currentPage)
            : \DB::table('posts');

        $postIds = $posts->pluck('id')->toArray();

        $allPostsAreSelected = empty(array_diff($postIds, $this->selectedPosts));

        if ($allPostsAreSelected) {
            $this->selectedPosts = array_diff($this->selectedPosts, $postIds);
        } else {
            $this->selectedPosts = array_merge($this->selectedPosts, $postIds);
            $this->selectedPosts = array_unique($this->selectedPosts);
        }

        $this->selectedPosts = array_values($this->selectedPosts);

        $message = sprintf(
            '%s posts selected',
            count($this->selectedPosts) ?: 'No'
        );

        $this->dispatch('notify', 'info', $message);
    }

    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
        $this->resetPage();
    }

    public function deletePostConfirm(Post $post, PostDelete $delete): void
    {
        try {
            $delete->handle($post);
            $this->dispatch('notify', 'success', 'Post deleted successfully');
        } catch (\Throwable $e) {
            $this->dispatch('notify', 'error', 'Failed to delete post');
        }
    }

    public function tableSelectionAction(BulkActionType $type, PostBulkOperator $operator): void
    {
        $message = sprintf(
            '%s posts handled successfully',
            count($this->selectedPosts) ?: 'No'
        );

        try {
            $operator->handle($this->selectedPosts, $type);
        } catch (\Throwable $e) {
            $verb = mb_strtolower($type->getLabel());
            $this->dispatch('notify', 'error', "Failed to $verb posts");
            return;
        }

        $this->dispatch('notify', 'success', $message);

        $this->selectedPosts = [];
    }

    public function render(): View
    {
        return view('livewire.post-table', [
            'posts' => Post::paginate($this->perPage),
        ]);
    }
}
