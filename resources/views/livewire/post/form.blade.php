<div>
    <form wire:submit="save" class="form-control">
        @csrf
        <div class="flex gap-6 justify-center">
            <section class="max-w-[55rem] w-full">
                <div class="h-20 flex items-center">
                    <div>
                        <input type="text" id="title" wire:model="title"
                               placeholder="{{ __('Enter title') }}"
                               class="input w-full border-0 focus:border-none focus:outline-none px-0 font-bold text-2xl">
                        @error('title')
                        <em class="text-error">{{ $message }}</em>
                        @enderror
                    </div>
                </div>

                <livewire:editor wire:model="content"/>

                @error('content')
                <em class="text-error">{{ $message }}</em>
                @enderror
            </section>
            <aside id="form-aside" class="sticky top-12 h-fit mt-16 transition-all">
                <div class="my-4 flex gap-2">
                    <x-button class="btn-success" :action="'save'" :label="'Save'"
                              :events="[\App\Livewire\Editor::EVENT_TRIGGER_SAVE]"/>
                </div>
                @if(isset($post))
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
                @endif
            </aside>
        </div>
    </form>


    {{-- ZEN MODE --}}
    <div x-data="{ zenMode: false }" class="fixed bottom-2 right-0 hidden md:block">
        <button @click="
        zenMode = !zenMode;
        document.getElementById('top-bar').classList.toggle('hidden');
        document.getElementById('side-bar').classList.toggle('hidden');
        document.getElementById('main').classList.toggle('!mx-0');
        document.getElementById('form-aside').classList.toggle('hidden');
        "
                class="rounded-lg font-semibold text-xs bg-base-100 py-1 px-2"
                role="button"
        >
            <span class="flex items-center gap-2 w-[10ch]" x-show="!zenMode"><i class="bx bx-fullscreen"></i> Enter Zen</span>
            <span class="flex items-center gap-2 w-[10ch]" x-show="zenMode"><i class="bx bx-exit-fullscreen"></i> Exit Zen</span>
        </button>
    </div>
</div>
