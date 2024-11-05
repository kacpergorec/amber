<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Notification extends Component
{
    public $notifications = [];

    protected $listeners = ['notify'];

    public function notify(string $type, string $message) : void
    {
        $this->notifications[] = [
            'type' => $type ?: 'neutral',
            'message' => $message,
            'id' => uniqid(),
        ];
    }

    public function render() : View
    {
        return view('livewire.notification');
    }
}
