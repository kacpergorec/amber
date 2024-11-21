<form wire:submit="save" class="form-control">
    @csrf
    <div class="my-2">
        <label for="title" class="label">
            {{ __('Title') }}
        </label>
        <input type="text" id="title" wire:model="title"
               class="input bg-white dark:bg-base-300 w-full border-neutral-200 dark:border-neutral-700">
        @error('title')
        <em class="text-error">{{ $message }}</em>
        @enderror
    </div>

    <div class="my-2">
        <label for="content" class="label">
            {{ __('Content') }}
        </label>
        <livewire:editor :value="$content"/>
        @error('content')
        <em class="text-error">{{ $message }}</em>
        @enderror
    </div>

    <button type="submit" class="btn btn-sm btn-primary">{{ __('Save Post') }}</button>
    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-neutral">{{ __('Return') }}</a>
</form>
