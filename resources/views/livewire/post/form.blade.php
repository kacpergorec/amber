<form wire:submit="save" class="form-control">
    @csrf
    <div class="flex gap-6 justify-center">
        <section class="max-w-[55rem] w-full">
            <div class="h-20 flex items-center">
                <div>
                    <input type="text" id="title" wire:model="title"
                           class="input w-full border-0 focus:border-none focus:outline-none px-0 font-bold text-2xl">
                    @error('title')
                    <em class="text-error">{{ $message }}</em>
                    @enderror
                </div>
            </div>

            <livewire:editor wire:model="content" />

            @error('content')
            <em class="text-error">{{ $message }}</em>
            @enderror
        </section>
        <aside id="form-aside" class="sticky top-12 h-fit mt-16 transition-all">
            <div class="my-4 flex gap-2">
                <x-button class="btn-success"  :action="'save'" :label="'Save'" :events="[\App\Livewire\Editor::EVENT_TRIGGER_SAVE]" />
            </div>
            <x-card>
                <ul class="space-y-2 text-left text-gray-500 dark:text-gray-400 text-sm">
                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                        <i class="bx bx-user"></i>
                        <span>Author: <span
                                class="font-semibold text-gray-900 dark:text-white">{{ $post->author->name }}</span></span>
                    </li>
                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                        <i class="bx bx-time"></i>
                        <span>Last modified: <span
                                class="font-semibold text-gray-900 dark:text-white">{{ $post->updated_at->diffForHumans() }}</span></span>
                    </li>
                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                        <i class="bx bx-calendar"></i>
                        <span>Date of creation: <span
                                class="font-semibold text-gray-900 dark:text-white">{{$post->created_at->diffForHumans()}}</span></span>
                    </li>
                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                        <i class="bx bx-check"></i>
                        <span>Published:
                                <span class="font-semibold text-gray-900 dark:text-white">
                                    {{$post->published_at?->diffForHumans() ?: 'No'}}
                                </span>
                            </span>
                    </li>
                </ul>
            </x-card>
        </aside>
    </div>
</form>

