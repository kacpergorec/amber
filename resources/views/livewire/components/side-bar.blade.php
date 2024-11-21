<aside id="side-bar"
    :class="{
        'w-52': !sidebarShrink,
        'w-16': sidebarShrink,
        '-translate-x-full': !sidebarOpen
    }"
    class="fixed top-0 left-0 h-screen bg-white dark:bg-neutral-800 shadow-lg md:translate-x-0 z-40 border-r border-neutral-200 dark:border-neutral-700"
    style="transition: width 0.14s cubic-bezier(.4,0,.2,1);">
    <nav class="flex flex-col h-full pt-12 mb-12">
        <ul>
            <li class="pt-3 px-3">
                <x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" :icon="'bx bx-home'" wire:navigate>
                    {{ __('Dashboard') }}
                </x-side-nav-link>
            </li>
            <li class="pt-3 px-3">
                <x-side-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')" :icon="'bx bx-news'" wire:navigate>
                    {{ __('Posts') }}
                </x-side-nav-link>
            </li>
        </ul>

        <div class="mt-auto p-4">
            <!-- Shrink/Expand ¬Toggle -->
            <button @click="sidebarShrink = !sidebarShrink" class="flex items-center justify-center p-2">
                <i class="bx" :class="sidebarShrink ? 'bx-arrow-from-left' : 'bx-arrow-to-left'"></i>
            </button>
        </div>
    </nav>
</aside>
