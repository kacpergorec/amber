<div x-data="{ bulkLoading: false }">

    {{--  Header --}}
    <div class="flex items-center gap-3">
        <h1 class="text-3xl my-3 sm:my-6 px-2 sm:px-0">
            {{ __('Posts') }}
        </h1>

        <x-pill-link :href="route('posts.create')" :icon="'bx bx-plus'">
            {{ __('Add new post') }}
        </x-pill-link>

        <x-pill-link :href="route('posts.index')" :icon="'bx bx-filter'">
            {{ __('Filters') }}
        </x-pill-link>

        @if (!empty($selectedItems))
            <div x-init="bulkLoading = false;
            $el.remove()"></div>
            @foreach (\App\Enums\PostBulkActionType::cases() as $type)
                @if ($type->hasConfirm())
                    <button
                        class="relative flex items-center btn btn-xs btn-subtle btn-{{ $type->getLevel() }} text-base hover:shadow-md transition-shadow rounded-full h-6 ps-2 pe-3 gap-2"
                        x-on:click="$dispatch('open-modal', 'confirm-{{ $type->value }}')"
                        wire:loading.class="pointer-events-none">
                        <span class="text-sm whitespace-nowrap">
                            {{ $type->getLabel() }} ({{ count($selectedItems) }})
                        </span>
                    </button>
                    <x-modal name="confirm-{{ $type->value }}" :show="false">
                        <div class="p-6 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
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
                    <button
                        class="relative flex items-center btn btn-xs btn-subtle btn-{{ $type->getLevel() }} hover:shadow-md transition-shadow rounded-full h-6 ps-2 pe-3 gap-2"
                        wire:click="tableSelectionAction('{{ $type->value }}')"
                        wire:loading.class="pointer-events-none">
                        <span class="text-sm whitespace-nowrap">
                            {{ $type->getLabel() }} ({{ count($selectedItems) }})
                        </span>
                    </button>
                @endif
            @endforeach
        @else
            <div x-init="bulkLoading = false; $el.remove()"></div>
        @endif

        <span x-show="bulkLoading">
            <i class="bx bx-loader-alt animate-spin"></i>
        </span>
    </div>

    {{--  Table --}}
    @if (!$posts->isEmpty())
        <x-card>
            <table class="table table-xs md:table-sm lg:table-md">
                <thead>

                    {{--  Bulk actions --}}
                    <tr>
                        <th>
                            <div class="dropdown relative z-10">
                                <label>
                                    <button class="checkbox checkbox-sm dark:bg-base-300"
                                        style="width: 20px; height: 20px" />
                                </label>
                                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box"
                                    wire:target="selectAll" wire:loading.class="hidden">
                                    <li>
                                        <a href="#" class="whitespace-nowrap"
                                            wire:click="selectAll({{ $posts->currentPage() }})"
                                            x-on:click="bulkLoading = true">
                                            {{ __('Every on this page') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="whitespace-nowrap" wire:click="selectAll()"
                                            x-on:click="bulkLoading = true">
                                            {{ __('Everything') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </th>

                        {{--  Table headers --}}
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

                {{--  Table body --}}
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr class="ease-in-out" wire:loading.class="hidden"
                            wire:target="deletePostConfirm('{{ $post->id }}')"
                            wire:key="post-{{ $post->id }}">
                            <td>
                                <div class="relative z-0">
                                    <input class="bulk-checkbox checkbox checkbox-sm dark:bg-base-300"
                                        id="select-{{ $post->id }}" type="checkbox"
                                        @if (in_array($post->id, $selectedItems)) checked @endif value="{{ $post->id }}"
                                        wire:loading.class="opacity-0 pointer-events-none" wire:target="selectAll"
                                        wire:model.live="selectedItems" x-on:click="bulkLoading = true" />
                                    <div class="hidden absolute top-0" role="status" wire:target="selectAll"
                                        wire:loading.class.remove="hidden">
                                        <svg aria-hidden="true"
                                            class="w-5 h-5 text-neutral-200 animate-spin dark:text-neutral-600 fill-neutral-600 dark:fill-neutral-300"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                            <td class="text-neutral-400">
                                <span x-data="{ id: '{{ $post->id }}' }" x-on:click="navigator.clipboard.writeText(id)"
                                    class="select-none cursor-pointer">
                                    {{ ++$key }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('posts.edit', $post) }}"
                                    class="link link-hover text-neutral-800 dark:text-neutral-200 text-ellipsis">
                                    {{ Str::words($post->title, 8) }}
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-ghost text-neutral-600 dark:text-neutral-400 transition-none"
                                    style="--tw-bg-opacity:.5">
                                    {{ $post->publishedAt ? __('Published') : __('Draft') }}
                                </span>
                            </td>
                            <td class="text-neutral-600 dark:text-neutral-400 text-nowrap">
                                {{ $post->author->name }}
                            </td>
                            <td>
                                <span class="text-neutral-600 dark:text-neutral-400 text-nowrap">
                                    {{ $post->updated_at->diffForHumans() }}
                                </span>
                            </td>

                            {{--  Actions --}}
                            <td>
                                <div class="flex gap-3 w-full justify-end font-semibold">
                                    <a href="{{ route('posts.edit', $post) }}#"
                                        class="bg-neutral-200 text-neutral-700 dark:bg-neutral-800 shadow rounded w-5 h-5 flex items-center justify-center dark:text-neutral-300 hover:text-info hover:dark:text-info hover:outline hover:outline-info">
                                        <i class="bx bx-pencil"></i>
                                    </a>
                                    <a href="#"
                                        class="bg-neutral-200 text-neutral-700 dark:bg-neutral-800 shadow rounded w-5 h-5 flex items-center justify-center dark:text-neutral-300 hover:text-error hover:dark:text-error hover:outline hover:outline-error"
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $post->id }}')">
                                        <i class="bx bx-trash-alt"></i>
                                    </a>
                                </div>
                                <x-modal name="confirm-delete-{{ $post->id }}" :show="false">
                                    <div class="p-6 flex justify-between items-center">
                                        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
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

            {{--  Pagination --}}
            <div class="flex justify-between mt-5">
                {{ $posts->links('livewire.components.pagination') }}
            </div>
        </x-card>
    @else
        {{--  No posts found --}}
        <div class="card bg-white dark:bg-base-300 p-3 rounded-lg">
            <h2 class="text-lg text-neutral-900 dark:text-neutral-100 text-center">
                {{ __('No posts found') }}
            </h2>
        </div>
    @endif
</div>
