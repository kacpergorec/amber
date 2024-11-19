<x-app-layout>
    <div class="max-w-7xl mx-auto px-0 sm:px-6 lg:px-8 pb-8">
        <div class="flex items-center gap-3">
            <h1 class="text-3xl my-3 sm:my-6 px-2 sm:px-0">
                {{__('Edit Post')}}
            </h1>
        </div>

        <div class="card bg-white dark:bg-base-300 overflow-x-scroll p-0 sm:p-3 rounded-none sm:rounded-lg mb-2">
            <livewire:post.form.edit :post="$post"/>
        </div>
    </div>
</x-app-layout>
