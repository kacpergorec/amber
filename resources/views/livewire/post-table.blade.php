<div class="card bg-white dark:bg-base-300 overflow-x-auto p-3">
    <table class="table">
        <thead>
        <tr>
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
                <td class="text-zinc-400">
                    {{++$key}}
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

    <div class="px-3 pt-4">
        {{$posts->links('livewire.layout.pagination')}}
    </div>
</div>
