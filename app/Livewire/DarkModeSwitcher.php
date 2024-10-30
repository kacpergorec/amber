<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class DarkModeSwitcher extends Component
{
    public $isDarkMode;

    public function mount() : void
    {
        $this->isDarkMode = session('dark_mode', false);
    }

    public function toggleDarkMode() : void
    {
        $this->isDarkMode = !$this->isDarkMode;
        session(['dark_mode' => $this->isDarkMode]);
    }

    public function render() : View
    {
        return view('livewire.dark-mode-switcher');
    }
}
