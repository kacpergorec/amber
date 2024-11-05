<?php

namespace App\Livewire;

use App\Handlers\PostDelete;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class PostTable extends Component
{
    use WithPagination;

    public $perPage = 10;

    public function mount() : void
    {
        $this->perPage = request()->query('per_page', 10);
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

    public function render(): View
    {
        return view('livewire.post-table', [
            'posts' => Post::paginate($this->perPage),
        ]);
    }
}
