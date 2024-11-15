<form wire:submit="save">
    @csrf
    <div>
        <label for="title">{{ __('Title') }}</label>
        <input type="text" id="title" wire:model="title">
        @error('title') <em>{{ $message }}</em> @enderror
    </div>
    <div>
        <label for="content">{{ __('Content') }}</label>
        <textarea id="content" wire:model="content"></textarea>
        @error('content') <em>{{ $message }}</em> @enderror
    </div>
    <button type="submit">{{ __('Save') }}</button>
</form>
