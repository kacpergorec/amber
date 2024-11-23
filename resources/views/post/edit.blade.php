<x-app-layout>
    <div class="mx-auto px-0 sm:px-6 lg:px-8 pb-8">
        <livewire:post.form.edit :post="$post" />
    </div>

    <div x-data="{ zenMode: false }" class="fixed bottom-2 right-0 hidden md:block">
        <button @click="
        zenMode = !zenMode;
        document.getElementById('top-bar').classList.toggle('hidden');
        document.getElementById('side-bar').classList.toggle('hidden');
        document.getElementById('main').classList.toggle('!mx-0');
        document.getElementById('form-aside').classList.toggle('hidden');
        "
                class="rounded-lg font-semibold text-xs bg-base-100 py-1 px-2"
                role="button"
        >
            <span class="flex items-center gap-2 w-[10ch]" x-show="!zenMode"><i class="bx bx-fullscreen"></i> Enter Zen</span>
            <span class="flex items-center gap-2 w-[10ch]" x-show="zenMode"><i class="bx bx-exit-fullscreen"></i> Exit Zen</span>
        </button>
    </div>
</x-app-layout>
