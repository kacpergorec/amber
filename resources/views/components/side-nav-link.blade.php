@props(['active', 'href', 'icon'])

@php
    $classes =
        $active ?? false
            ? 'h-9 w-9 flex items-center p-2 px-3 rounded-lg bg-primary-500/10 dark:bg-primary-500/5 text-black dark:text-white'
            : 'h-9 w-9 flex items-center p-2 px-3 hover:bg-neutral-100 dark:hover:bg-neutral-700/50 rounded-lg';
@endphp

<a class="{{ $classes }}" href="{{ $href }}">
    <i class="mx-auto text-xs {{ $active ? 'text-primary-500 ' . $icon : str_replace('bx-', 'bxs-', $icon) }}"></i>
    <span class="whitespace-nowrap transition-all"
        :class="{
            'justify-center': sidebarShrink,
            'w-auto opacity-100 ml-6': !sidebarShrink,
            'w-0 opacity-0 m-0': sidebarShrink
        }">
        {{ $slot }}
    </span>
</a>
