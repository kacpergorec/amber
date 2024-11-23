@php(
    /** @var int $alertPosition */
   $alertPosition = 0
)
<div class="fixed top-14 right-9 space-y-2" style="z-index: 60">
    @foreach ($notifications as $notification)
        <div class="shadow-lg rounded-lg alert alert-{{ $notification['type'] }}" x-data="{ show: false }" x-init="setTimeout(() => { show = true; }, 100);
        setTimeout(() => { show = false; }, 5000);" x-show="show"
             x-on:click="show = false" x-transition:enter="transition ease-out transform"
             x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in transform" x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full">
            <div class="flex gap-3 justify-center items-center">
                <div class="icon w-6 h-6 bg-black/10 rounded-lg flex items-center justify-center">
                    @switch($notification['type'])
                        @case('success')
                            <i class='bx bx-check'></i>
                            @break

                        @case('error')
                            <i class='bx bx-x'></i>
                            @break

                        @case('warning')
                            <i class='bx bx-error'></i>
                            @break

                        @default
                        @case('info')
                            <i class='bx bx-info-circle'></i>
                    @endswitch
                </div>
                <div class="message">
                    {{ $notification['message'] }}
                </div>
            </div>
        </div>
    @endforeach
</div>
