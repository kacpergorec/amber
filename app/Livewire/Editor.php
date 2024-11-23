<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Editor extends Component
{
    public const EVENT_TRIGGER_SAVE = 'editor_trigger_save';

    public function __construct(
        #[Modelable]
        public ?string  $content = null,
        public ?string $name = null
    )
    {
        if ($name === null) {
            $this->name = uniqid('editor_');
        }
    }

    public function mount() : void
    {
        $this->sanitizeHtml();
    }

    public function render(): View
    {
        return view('livewire.components.editor');
    }

    private function sanitizeHtml() : void
    {
        $this->content = strip_tags($this->content, '<h1><h2><h3><h4><h5><h6><p><a><ul><ol><li><strong><em><del><ins><code><pre><blockquote><figure><img><video><audio><table><thead><tbody><tfoot><tr><th><td><hr><br><div></div><span>');
    }
}
