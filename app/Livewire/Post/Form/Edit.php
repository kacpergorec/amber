<?php
declare (strict_types=1);

namespace App\Livewire\Post\Form;

use App\Livewire\Editor;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component
{
    public string $title = '';

    public string $content = '';

    public $listeners = [
        Editor::EVENT_VALUE_UPDATED => 'setContent',
    ];

    //todo create DTO
    public function setContent(string $value, string $name) : void
    {
        $this->content = $value;
    }

    public function mount(Post $post) : void
    {
        $this->title = $post->title;
        $this->content = $post->content;
    }

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
