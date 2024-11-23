@props(['action', 'label', 'events' => []])
@php
    $classes = 'btn px-3 py-2 grow';
    $classes = $attributes->merge(['class' => $classes]);

    $loadingClasses = 'pointer-events-none btn-disabled';
@endphp

<a
    wire:click="{{$action}}"
    wire:target="{{$action}}"
    wire:loading.class="pointer-events-none btn-disabled"
    {{$classes}}

>

    <i class="bx bx-loader-alt animate-spin" wire:loading wire:target="{{$action}}"></i>
    {{__($label)}}
</a>

<script>
    @json($events).forEach(event => {
        Livewire.on(event, () => {
            document.querySelector('.btn').click();
        });
    });
</script>
