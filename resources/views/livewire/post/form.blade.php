<form wire:submit="save" class="form-control">
    @csrf
    <div class="flex items-center gap-3 py-4">
        <input type="text" id="title" wire:model="title" class="input bg-base-300 w-full">
        @error('title')
        <em class="text-error">{{ $message }}</em>
        @enderror
    </div>

    <livewire:editor :value="$content"/>

    @error('content')
    <em class="text-error">{{ $message }}</em>
    @enderror

    <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-base-300 p-4 shadow-lg flex justify-center gap-3">
        <button type="submit" class="btn btn-sm btn-primary">{{ __('Save Post') }}</button>
        <a href="{{route('posts.index')}}" class="btn btn-sm btn-neutral">{{__('Return')}}</a>
    </div>
</form>
