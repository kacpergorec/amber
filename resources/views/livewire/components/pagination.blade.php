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
                        class="bg-transparent border-t-0 border-l-0 border-r-0 border-b select-xs w-full max-w-xs py-0 ps-2 pe-[25px] border-neutral-300/60 dark:border-neutral-700/60">
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
                            class="relative inline-flex items-center px-[0.6rem] py-1 text-sm font-medium text-neutral-500 bg-white cursor-default leading-5 rounded-lg dark:text-neutral-300 dark:focus:-blue-700">
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
                            class="relative inline-flex items-center px-[0.6rem] py-1 text-sm font-medium text-neutral-700 bg-white leading-5 rounded-lg hover:underline focus:outline-none focus:-blue-300  dark:text-neutral-300 dark:focus:-blue-700 ">
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
                            class="relative inline-flex items-center px-[0.6rem] py-1 text-sm font-medium text-neutral-700 bg-white leading-5 rounded-lg hover:underline focus:outline-none focus:-blue-300  dark:text-neutral-300 dark:focus:-blue-700 ">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <span
                            class="relative inline-flex items-center px-[0.6rem] py-1 text-sm font-medium text-neutral-500 bg-white cursor-default leading-5 rounded-lg dark:text-neutral-600">
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
            <div class="flex gap-2 items-center">
                <div class="flex gap-1 ms-3 items-center">
                    <p class="text-sm text-neutral-700 dark:text-neutral-400 whitespace-nowrap">
                        Show:
                    </p>
                    <select wire:model="perPage" wire:change="setPerPage($event.target.value)"
                        class="bg-transparent border-t-0 border-l-0 border-r-0 border-b select-xs w-full max-w-xs py-0 ps-2 pe-[25px] border-neutral-300/60 dark:border-neutral-700/60">
                        @foreach ([10, 25, 50, 100, 500] as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <p class="text-sm text-neutral-700 leading-5 dark:text-neutral-400 hidden md:block">
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    <span>-</span>
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    <span>{!! __('of') !!}</span>
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    <span>{!! __('results') !!}</span>
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse gap-1 rounded-lg">
                    <span>
                        {{-- Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                <span
                                    class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-neutral-500 cursor-default rounded-lg leading-5"
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
                                class="relative inline-flex items-center px-1 py-1 text-sm font-medium text-neutral-500 rounded-lg leading-5 hover:underline focus:z-10 focus:outline-none  dark:focus:border-primary"
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
                                    class="rounded-lg relative inline-flex items-center px-2 py-1 -ml-px text-sm font-medium text-neutral-700 cursor-default leading-5 dark:text-neutral-300">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                    @if ($page == $paginator->currentPage())
                                        <span aria-current="page">
                                            <span
                                                class="font-bold relative inline-flex items-center px-2 py-1 -ml-px text-sm cursor-default leading-5 bg-primary-500/10 text-primary-500 rounded-lg">{{ $page }}</span>
                                        </span>
                                    @else
                                        <button type="button"
                                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                            class="rounded-lg relative inline-flex items-center px-2 py-1 -ml-px text-sm font-medium text-neutral-700 leading-5 hover:underline focus:z-10 focus:outline-none  dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:border-primary"
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
                                class="relative inline-flex items-center px-1 py-1 -ml-px text-sm font-medium text-neutral-500 rounded-lg leading-5 hover:underline focus:z-10 focus:outline-none  dark:focus:border-primary"
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
                                    class="relative inline-flex items-center px-1 py-1 -ml-px text-sm font-medium text-neutral-500 cursor-default rounded-lg leading-5"
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
