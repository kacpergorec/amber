<?php

use App\Livewire\Auth\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-error" x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">

            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input wire:model="password" id="password" name="password" type="password"
                    class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button class="btn btn-secondary" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>

                <button class="btn btn-error ms-3">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
