<div>
    @if (!empty($selectedItems))
        <div class="card bg-white dark:bg-base-300 overflow-x-scroll p-0 sm:p-3 rounded-none sm:rounded-lg mb-2">
            <div class="flex gap-3">
                @foreach (\App\Enums\PostBulkActionType::cases() as $type)
                    @if ($type->hasConfirm())
                        <button class="btn btn-sm btn-{{ $type->getLevel() }}"
                            x-on:click="$dispatch('open-modal', 'confirm-{{ $type->value }}')"
                            wire:loading.class="pointer-events-none animate-pulse">
                            {{ $type->getLabel() }}
                        </button>
                        <x-modal name="confirm-{{ $type->value }}" :show="false">
                            <div class="p-6 flex justify-between items-center">
                                <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
                                    {{ __('Are you sure you want to perform this action?') }}
                                </h2>
                                <div>
                                    <button class="btn btn-ghost me-3"
                                        x-on:click="$dispatch('close-modal', 'confirm-{{ $type->value }}')">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button class="btn btn-{{ $type->getLevel() }}"
                                        wire:click="tableSelectionAction('{{ $type->value }}')"
                                        x-on:click="$dispatch('close-modal', 'confirm-{{ $type->value }}')">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>
                            </div>
                        </x-modal>
                    @else
                        <button class="btn btn-sm btn-{{ $type->getLevel() }}"
                            wire:click="tableSelectionAction('{{ $type->value }}')"
                            wire:loading.class="pointer-events-none animate-pulse">
                            {{ $type->getLabel() }}
                        </button>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    @if (!$posts->isEmpty())
        <div class="card bg-white dark:bg-base-300 overflow-x-scroll p-0 sm:p-3 rounded-none sm:rounded-t-lg">
            <table class="table table-xs md:table-sm lg:table-md">
                <thead>
                    <tr>
                        <th>
                            <div class="dropdown relative z-10">
                                <label>
                                    <button class="checkbox checkbox-sm dark:bg-base-300"
                                        style="width: 20px; height: 20px" />
                                </label>
                                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box"
                                    wire:target="selectAll" wire:loading.class="hidden">
                                    <li><a href="#" class="whitespace-nowrap"
                                            wire:click="selectAll({{ $posts->currentPage() }})">{{ __('Every on this page') }}</a>
                                    </li>
                                    <li>
                                        <a href="#" class="whitespace-nowrap" wire:click="selectAll()">
                                            {{ __('Everything') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </th>
                        <th>#</th>
                        <th wire:click="sortBy('title')" class="cursor-pointer">
                            @if ($sortField === 'title')
                                <i class="bx bx-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                            {{ __('Title') }}
                        </th>
                        <th wire:click="sortBy('published_at')" class="cursor-pointer">
                            @if ($sortField === 'published_at')
                                <i class="bx bx-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                            {{ __('Status') }}
                        </th>
                        <th wire:click="sortBy('author.name')" class="cursor-pointer">
                            @if ($sortField === 'author.name')
                                <i class="bx bx-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                            {{ __('Author') }}
                        </th>
                        <th wire:click="sortBy('updated_at')" class="cursor-pointer">
                            @if ($sortField === 'updated_at')
                                <i class="bx bx-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @endif
                            {{ __('Modified') }}
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr class="ease-in-out" wire:loading.class="hidden"
                            wire:target="deletePostConfirm('{{ $post->id }}')"
                            wire:key="post-{{ $post->id }}">
                            <td>
                                <div class="relative z-0">
                                    <input class="checkbox checkbox-sm dark:bg-base-300"
                                        id="select-{{ $post->id }}" type="checkbox"
                                        @if (in_array($post->id, $selectedItems)) checked @endif
                                        wire:loading.class="opacity-0 pointer-events-none" wire:target="selectAll"
                                        wire:model.live="selectedItems" value="{{ $post->id }}" />
                                    <div class="hidden absolute top-0" role="status" wire:target="selectAll"
                                        wire:loading.class.remove="hidden">
                                        <svg aria-hidden="true"
                                            class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600 dark:fill-gray-300"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-zinc-400">
                                <span x-data="{ id: '{{ $post->id }}' }" x-on:click="navigator.clipboard.writeText(id)"
                                    class="select-none cursor-pointer">
                                    {{ ++$key }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('posts.edit', $post) }}"
                                    class="link link-hover text-zinc-800 dark:text-zinc-200 text-ellipsis">
                                    {{ Str::words($post->title, 8) }}
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-ghost text-zinc-600 dark:text-zinc-400"
                                    style="--tw-bg-opacity:.5">
                                    {{ $post->publishedAt ? __('Published') : __('Draft') }}
                                </span>
                            </td>
                            <td class="text-zinc-600 dark:text-zinc-400">
                                {{ $post->author->name }}
                            </td>
                            <td>
                                <span class="text-zinc-600 dark:text-zinc-400 text-nowrap">
                                    {{ $post->updated_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>
                                <div class="flex gap-3 w-full justify-end font-semibold">
                                    <a href="#"
                                        class="bg-zinc-200 text-zinc-700 dark:bg-zinc-800 shadow rounded w-5 h-5 flex items-center justify-center dark:text-zinc-300 hover:text-info hover:dark:text-info hover:outline hover:outline-info">
                                        <i class="bx bx-pencil"></i>
                                    </a>
                                    <a href="#"
                                        class="bg-zinc-200 text-zinc-700 dark:bg-zinc-800 shadow rounded w-5 h-5 flex items-center justify-center dark:text-zinc-300 hover:text-error hover:dark:text-error hover:outline hover:outline-error"
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $post->id }}')">
                                        <i class="bx bx-trash-alt"></i>
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
        </div>
        <div class="card bg-white dark:bg-base-300 p-3 rounded-t-none">
            <div class="flex justify-between">
                {{ $posts->links('livewire.components.pagination') }}
            </div>
        </div>
    @else
        <div class="card bg-white dark:bg-base-300 p-3 rounded-lg">
            <h2 class="text-lg text-zinc-900 dark:text-zinc-100 text-center">
                {{ __('No posts found') }}
            </h2>
        </div>
    @endif
</div>
