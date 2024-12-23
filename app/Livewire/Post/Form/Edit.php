<?php
declare (strict_types=1);

namespace App\Livewire\Post\Form;

use App\Modules\Post\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Edit extends Component
{
    public Post $post;

    #[Rule(['required', 'string', 'min:3'])]
    public string $title = '';

    public string $content = '';

    public function mount(Post $post) : void
    {
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function save() : void
    {
        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->dispatch('notify','success', 'Post updated successfully!');
    }

    public function render() : View
    {
        return view('livewire.post.form');
    }
}
