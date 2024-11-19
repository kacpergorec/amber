<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Editor extends Component
{
    public const EVENT_VALUE_UPDATED = 'editor_value_updated';

    public function __construct(
        public string $value = '',
        public ?string $name = null
    )
    {
        if ($name === null) {
            $this->name = uniqid('editor_');
        }

        $this->clearHtml();
    }

    public function updatedValue(): void
    {
        $this->clearHtml();
        $this->dispatch(self::EVENT_VALUE_UPDATED, $this->value, $this->name);
    }

    public function render(): View
    {
        return view('livewire.components.editor');
    }

    private function clearHtml() : void
    {
        $this->value = strip_tags($this->value, '<h1><h2><h3><h4><h5><h6><p><a><ul><ol><li><strong><em><del><ins><code><pre><blockquote><figure><img><video><audio><table><thead><tbody><tfoot><tr><th><td><hr><br><span><div>');
    }
}
