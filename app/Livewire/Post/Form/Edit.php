<?php
declare (strict_types=1);

namespace App\Livewire\Post\Form;

use App\Livewire\Editor;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;

class Edit extends Component
{
    public Post $post;

    #[Rule(['required', 'string', 'min:3'])]
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
