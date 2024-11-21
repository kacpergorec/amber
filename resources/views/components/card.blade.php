@php
    $classes =
        'bg-white dark:bg-base-300 p-0 sm:p-3 rounded-none sm:rounded-lg sm:border border-neutral-200 dark:border-neutral-700';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
