<?php

use App\Livewire\Auth\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<button wire:click="logout" class="w-full text-start">
    <x-nav-link>
        {{ __('Log Out') }}
    </x-nav-link>
</button>
