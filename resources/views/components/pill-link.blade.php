@props(['href', 'icon'])

@php
    $classes =
        'relative flex items-center text-base bg-white hover:shadow-md transition-shadow rounded-full h-6 ps-2 pe-3 gap-2 dark:bg-base-300';
@endphp

<a class="{{ $classes }}" href="{{ $href }}">
    <i class="{{ $icon }}"></i>
    <span class="text-sm whitespace-nowrap">
        {{ $slot }}
    </span>
</a>
