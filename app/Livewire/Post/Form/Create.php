<?php
declare (strict_types=1);

namespace App\Livewire\Post\Form;

use App\Modules\Post\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule(['required', 'string', 'min:3'])]
    public string $title = '';

    public string $content = '';

    public function save() : void
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'author_id' => auth()->id(),
        ]);

        $this->dispatch('notify', 'success', 'Post created successfully!');

        $this->redirect(route('posts.index'));
    }

    public function render() : View
    {
        return view('livewire.post.form');
    }
}
