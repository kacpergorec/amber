<form wire:submit="save" class="form-control">
    @csrf
    <div class="mb-4">
        <label for="title" class="label">
            <span class="label-text">{{ __('Title') }}</span>
        </label>
        <input type="text" id="title" wire:model="title" class="input w-full max-w-xs">
        @error('title')
        <em class="text-error">{{ $message }}</em>
        @enderror
    </div>
    <div class="mb-4">
        <label for="content" class="label">
            <span class="label-text">{{ __('Content') }}</span>
        </label>

        <livewire:editor :value="$content" />

        @error('content')
        <em class="text-error">{{ $message }}</em>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
</form>


