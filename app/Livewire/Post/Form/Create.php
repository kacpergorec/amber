<?php
declare (strict_types=1);

namespace App\Livewire\Post\Form;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Create extends Component
{
    public string $title = '';

    public string $content = '';

    public function save() : void
    {
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
