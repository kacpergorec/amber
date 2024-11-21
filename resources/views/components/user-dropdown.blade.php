<div x-data="{ userMenuOpen: false }" @click.outside="userMenuOpen = false" @close.stop="userMenuOpen = false" @focus="userMenuOpen = true" tabindex="0">
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
              <livewire:components.logout />
            </li>
        </ul>
    </div>
</div>
