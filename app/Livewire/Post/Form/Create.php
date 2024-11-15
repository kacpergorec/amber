<?php
declare (strict_types=1);

namespace App\Livewire\Post\Form;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    #[Rule(['required', 'string', 'min:3'])]
    public string $title = '';

    #[Rule(['required', 'string', 'min:3'])]
    public string $content = '';

    public function save() : void
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'author_id' => auth()->id(),
        ]);

        $this->redirect(route('posts.index'));
    }

    public function render() : View
    {
        return view('livewire.post.form');
    }
}
