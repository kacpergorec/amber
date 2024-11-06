<div class="card bg-white dark:bg-base-300 overflow-visible p-3">
    <table class="table">
        <thead>
        <tr>
            <th>
                <div class="dropdown">
                    <label>
                        <button class="checkbox checkbox-sm dark:bg-base-300" style="max-width: 20px; max-height: 20px"/>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box"
                        wire:target="selectAll" wire:loading.class="hidden">
                        <li><a href="#" class="whitespace-nowrap"
                               wire:click="selectAll({{$posts->currentPage()}})">{{__('Every on this page')}}</a></li>
                        <li><a href="#" class="whitespace-nowrap" wire:click="selectAll()">{{__('Everything')}}</a></li>
                    </ul>
                </div>
            </th>
            <th>#</th>
            <th>{{__('Title')}}</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Author')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $key => $post)
            <tr class="ease-in-out" wire:loading.class="hidden" wire:target="deletePostConfirm('{{$post->id}}')">
                <td>
                    <input class="checkbox checkbox-sm dark:bg-base-300"
                           id="select-{{$post->id}}"
                           type="checkbox"
                           checked="{{ in_array($post->id, $selectedPosts) }}"
                           wire:model="selectedPosts"
                           value="{{ $post->id }}"

                    />
                </td>
                <td class="text-zinc-400">
                    <span x-data="{ id: '{{ $post->id }}' }" x-on:click="navigator.clipboard.writeText(id)" class="select-none cursor-pointer">
                        {{ ++$key }}
                    </span>
                </td>
                <td>
                    <a href="{{route('posts.edit',$post)}}" class="link link-hover">
                        {{$post->title}}
                    </a>
                </td>
                <td>
                    <span class="badge badge-ghost text-zinc-900 dark:text-zinc-100" style="--tw-bg-opacity:.5">
                        {{$post->publishedAt ? __('Published') : __('Draft')}}
                    </span>
                </td>
                <td>
                    {{$post->author->name}}
                </td>
                <td>
                    <div class="flex gap-4 w-full justify-end font-semibold">
                        <a href="{{route('posts.edit',$post)}}" class="link link-hover link-info">
                            {{__('Edit')}}
                        </a>
                        <a href="#" class="link link-hover link-error"
                           x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $post->id }}')">
                            {{__('Delete')}}
                        </a>
                    </div>
                    <x-modal name="confirm-delete-{{ $post->id }}" :show="false">
                        <div class="p-6 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
                                {{ __('Are you sure you want to delete this post?') }}
                            </h2>
                            <div>
                                <button class="btn btn-ghost me-3"
                                        x-on:click="$dispatch('close-modal', 'confirm-delete-{{ $post->id }}')">
                                    {{ __('Cancel') }}
                                </button>
                                <button class="btn btn-error"
                                        wire:click="deletePostConfirm('{{ $post->id }}')"
                                        x-on:click="$dispatch('close-modal', 'confirm-delete-{{ $post->id }}')">
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                    </x-modal>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="px-3 pt-6 flex justify-between">
        {{$posts->links('livewire.layout.pagination')}}
    </div>
</div>
