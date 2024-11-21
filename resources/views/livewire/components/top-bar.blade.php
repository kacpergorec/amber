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

<nav class="fixed top-0 z-50 w-full bg-white dark:bg-neutral-800 border-b border-neutral-200 dark:border-neutral-700">
    <div class="md:px-6 h-12 flex">
        <div class="flex grow items-center justify-between">
            <!-- Sidebar Toggle Button -->
            <div class="flex items-center justify-start rtl:justify-end">
                <button aria-controls="logo-sidebar" type="button" @click="sidebarOpen = !sidebarOpen"
                    @click.outside="if (!$event.target.closest('#side-bar')) sidebarOpen = false"
                    class="inline-flex items-center p-2 text-sm text-neutral-500 rounded-lg md:hidden hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-200 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:ring-neutral-600">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <x-application-logo class="block h-9 w-auto fill-current text-neutral-800 dark:text-neutral-200" />
            </div>
            {{-- Search Bar --}}
            <form class="max-w-md mx-auto">
                <div class="relative w-full">
                    <input type="search" id="location-search"
                        class="block border-none p-1 px-3 w-64 z-20 text-sm text-neutral-900 bg-neutral-50 rounded-lg focus:ring-primary-500 dark:bg-base-200 dark:placeholder-neutral-400 dark:text-white"
                        placeholder="Search everywhere" />
                    <button type="submit"
                        class="absolute top-0 end-0 h-full border-none p-1 z-20 text-sm rounded-r-lg focus:ring-primary-500">
                        <svg class="w-3 h-3 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </form>
            {{-- User Menu --}}
            <div class="flex items-center">
                <div class="flex items-center gap-4 ms-3">
                    <livewire:components.dark-mode-switcher />

                    <div x-data="{ userMenuOpen: false }">
                        <button @click="userMenuOpen = !userMenuOpen" type="button"
                            class="flex text-sm bg-neutral-800 rounded-full focus:ring-4 focus:ring-neutral-300 dark:focus:ring-neutral-600"
                            aria-expanded="false">
                            <img class="w-8 h-8 rounded-full" src="https://avatar.iran.liara.run/public"
                                alt="user photo">
                        </button>
                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                            class="absolute right-5 z-50 my-4 text-base list-none bg-white divide-y divide-neutral-100 rounded shadow dark:bg-neutral-700 dark:divide-neutral-600"
                            id="dropdown-user">
                            <div class="px-4 py-3">
                                <p x-text="name" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                    x-on:profile-updated.window="name = $event.detail.name"
                                    class="text-sm text-neutral-900 dark:text-white">
                                </p>
                                <p class="text-sm font-medium text-neutral-900 truncate dark:text-neutral-300">
                                    {{ auth()->user()->email }}
                                </p>
                            </div>
                            <ul class="py-1">
                                <li>
                                    <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
                                        {{ __('Profile') }}
                                    </x-nav-link>
                                </li>
                                <li>
                                    <x-nav-link :href="'#'" :active="false" wire:navigate>
                                        {{ __('Settings') }}
                                    </x-nav-link>
                                </li>
                                <li>
                                    <button wire:click="logout" class="w-full text-start">
                                        <x-nav-link>
                                            {{ __('Log Out') }}
                                        </x-nav-link>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
