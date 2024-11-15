<x-app-layout>
    <div class="max-w-7xl mx-auto px-0 sm:px-6 lg:px-8 pb-8">
        <div class="flex items-center gap-3">
            <h1 class="text-3xl my-3 sm:my-6 px-2 sm:px-0">
                {{ __('Posts') }}
            </h1>
            <a href="{{ route('posts.create') }}"
                class="relative flex items-center text-base bg-white hover:shadow-md transition-shadow rounded-full h-6 ps-2 pe-3 gap-2 dark:bg-base-300">
                <i class="bx bx-plus text-xs"></i>
                <span class="text-sm">
                    {{ __('Add new post') }}
                </span>
            </a>
            <a href="#"
                class="relative flex items-center text-base bg-white hover:shadow-md transition-shadow rounded-full h-6 ps-2 pe-3 gap-2 dark:bg-base-300">
                <i class="bx bx-filter text-xs"></i>
                <span class="text-sm">
                    {{ __('Filters') }}
                </span>
            </a>
        </div>
        <livewire:post.table />
    </div>
</x-app-layout>
