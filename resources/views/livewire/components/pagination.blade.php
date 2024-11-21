@php
    /** @var \Illuminate\Pagination\Paginator $paginator */

    if (!isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet =
        $scrollTo !== false
            ? sprintf("(\$el.closest('%s') || document.querySelector('%s')).scrollIntoView()", $scrollTo, $scrollTo)
            : '';

@endphp

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between w-full">
        <div class="flex justify-between flex-1 md:hidden items-center">
            <div>
                <div class="flex gap-1 items-center">
                    <select wire:model="perPage" wire:change="setPerPage($event.target.value)"
                        class="bg-white dark:bg-neutral-800 border-neutral-300 dark:border-neutral-700 rounded select-sm w-full max-w-xs pt-0 ps-2 pe-[17px]">
                        @foreach ([10, 25, 50, 100, 500] as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <p class="text-sm text-neutral-500 whitespace-nowrap block ">
                        per page
                    </p>
                </div>
            </div>
            <div class="flex gap-2 items-center">
                <span>
                    @if ($paginator->onFirstPage())
                        <span
                            class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default leading-5 rounded-md dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:focus:border-blue-700 dark:active:bg-neutral-700 dark:active:text-neutral-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-neutral-700 bg-white border border-neutral-300 leading-5 rounded-md hover:text-neutral-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-neutral-100 active:text-neutral-700 transition ease-in-out duration-150 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:focus:border-blue-700 dark:active:bg-neutral-700 dark:active:text-neutral-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </span>
                <span class="text-sm text-neutral-500 whitespace-nowrap">
                    {{ $paginator->currentPage() }} / {{ $paginator->isEmpty() ? 1 : $paginator->lastPage() }}
                </span>
                <span>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                            class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-neutral-700 bg-white border border-neutral-300 leading-5 rounded-md hover:text-neutral-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-neutral-100 active:text-neutral-700 transition ease-in-out duration-150 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:focus:border-blue-700 dark:active:bg-neutral-700 dark:active:text-neutral-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <span
                            class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default leading-5 rounded-md dark:text-neutral-600 dark:bg-neutral-800 dark:border-neutral-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    @endif
                </span>
            </div>
        </div>

        <div class="hidden md:flex flex-1 items-center justify-between">
            <div class="flex gap-2">
                <p class="text-sm text-neutral-700 leading-5 dark:text-neutral-400">
                    <span>{!! __('Showing') !!}</span>
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    <span>{!! __('to') !!}</span>
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    <span>{!! __('of') !!}</span>
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    <span>{!! __('results') !!}</span>
                </p>
                <div class="flex gap-1 ms-3">
                    <select wire:model="perPage" wire:change="setPerPage($event.target.value)"
                        class="bg-white dark:bg-neutral-800 border-neutral-300 dark:border-neutral-700 rounded select-xs w-full max-w-xs py-0 ps-2 pe-[17px]">
                        @foreach ([10, 25, 50, 100, 500] as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <p class="text-sm text-neutral-500 whitespace-nowrap">
                        results per page
                    </p>
                </div>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse rounded-md">
                    <span>
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                <span
                                    class="relative inline-flex items-center px-2 py-1 text-sm font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default rounded-l-md leading-5 dark:bg-neutral-800 dark:border-neutral-700"
                                    aria-hidden="true">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        @else
                            <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                class="relative inline-flex items-center px-2 py-1 text-sm font-medium text-neutral-500 bg-white border border-neutral-300 rounded-l-md leading-5 hover:text-neutral-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-neutral-100 active:text-neutral-500 transition ease-in-out duration-150 dark:bg-neutral-800 dark:border-neutral-700 dark:active:bg-neutral-700 dark:focus:border-blue-800"
                                aria-label="{{ __('pagination.previous') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        @endif
                    </span>

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-3 py-1 -ml-px text-sm font-medium text-neutral-700 bg-white border border-neutral-300 cursor-default leading-5 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                    @if ($page == $paginator->currentPage())
                                        <span aria-current="page">
                                            <span
                                                class="font-bold relative inline-flex items-center px-3 py-1 -ml-px text-sm dark:text-primary-700 text-primary-500 border border-neutral-300 cursor-default leading-5 bg-primary-500 bg-opacity-5 dark:border-neutral-700">{{ $page }}</span>
                                        </span>
                                    @else
                                        <button type="button"
                                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                            class="relative inline-flex items-center px-3 py-1 -ml-px text-sm font-medium text-neutral-700 bg-white border border-neutral-300 leading-5 hover:text-neutral-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-neutral-100 active:text-neutral-700 transition ease-in-out duration-150 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-300 dark:active:bg-neutral-700 dark:focus:border-blue-800"
                                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                            {{ $page }}
                                        </button>
                                    @endif
                                </span>
                            @endforeach
                        @endif
                    @endforeach

                    <span>
                        {{-- Next Page Link --}}
                        @if ($paginator->hasMorePages())
                            <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                                class="relative inline-flex items-center px-2 py-1 -ml-px text-sm font-medium text-neutral-500 bg-white border border-neutral-300 rounded-r-md leading-5 hover:text-neutral-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-300 active:bg-neutral-100 active:text-neutral-500 transition ease-in-out duration-150 dark:bg-neutral-800 dark:border-neutral-700 dark:active:bg-neutral-700 dark:focus:border-blue-800"
                                aria-label="{{ __('pagination.next') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        @else
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span
                                    class="relative inline-flex items-center px-2 py-1 -ml-px text-sm font-medium text-neutral-500 bg-white border border-neutral-300 cursor-default rounded-r-md leading-5 dark:bg-neutral-800 dark:border-neutral-700"
                                    aria-hidden="true">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        @endif
                    </span>
                </span>
            </div>
        </div>
    </nav>
@endif
