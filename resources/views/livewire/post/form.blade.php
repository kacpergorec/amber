<form wire:submit="save" class="form-control">
    @csrf
    <div class="flex gap-3">
        <section class="columns-8">
            <div class="my-2">
                <label for="title" class="label">
                    {{ __('Title') }}
                </label>
                <input type="text" id="title" wire:model="title"
                       class="input bg-white dark:bg-base-300 w-full border-neutral-200 dark:border-neutral-700">
                @error('title')
                <em class="text-error">{{ $message }}</em>
                @enderror
            </div>
            <div class="my-2">
                <label for="content" class="label">
                    {{ __('Content') }}
                </label>
                <livewire:editor :value="$content"/>
                @error('content')
                <em class="text-error">{{ $message }}</em>
                @enderror
            </div>
        </section>
        <section class="columns-4">
            <div class="my-2">
                <label for="title" class="label">
                    {{ __('Details') }}
                </label>
                <x-card>
                    <ul class="space-y-2 text-left text-gray-500 dark:text-gray-400 text-sm">
                        <li class="flex items-center space-x-3 rtl:space-x-reverse">
                            <i class="bx bx-user"></i>
                            <span>Author: <span class="font-semibold text-gray-900 dark:text-white">John Doe</span></span>
                        </li>
                        <li class="flex items-center space-x-3 rtl:space-x-reverse">
                            <i class="bx bx-time"></i>
                            <span>Last modified: <span class="font-semibold text-gray-900 dark:text-white">2023-10-01</span></span>
                        </li>
                        <li class="flex items-center space-x-3 rtl:space-x-reverse">
                            <i class="bx bx-calendar"></i>
                            <span>Date of creation: <span class="font-semibold text-gray-900 dark:text-white">2023-01-01</span></span>
                        </li>
                        <li class="flex items-center space-x-3 rtl:space-x-reverse">
                            <i class="bx bx-check"></i>
                            <span>Published: <span class="font-semibold text-gray-900 dark:text-white">Yes</span></span>
                        </li>
                    </ul>
                </x-card>
            </div>
        </section>
    </div>
</form>
