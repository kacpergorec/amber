<nav id="top-bar" class="fixed top-0 z-50 w-full bg-white dark:bg-neutral-800 border-b border-neutral-200 dark:border-neutral-700">
    <div class="md:px-6 h-12 flex">
        <div class="flex grow items-center justify-between">
            <x-hamburger/>
{{--            <livewire:components.search-everywhere />--}}
            <div class="flex items-center">
                <div class="flex items-center gap-4 ms-3">
                    <livewire:components.dark-mode-switcher />

                    <x-user-dropdown/>
                </div>
            </div>
        </div>
    </div>
</nav>
