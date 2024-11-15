<form wire:submit="save">
    @csrf
    <div>
        <label for="title">{{ __('Title') }}</label>
        <input type="text" id="title" wire:model="title">
    </div>
    <div>
        <label for="content">{{ __('Content') }}</label>
        <textarea id="content" wire:model="content"></textarea>
    </div>
    <button type="submit">{{ __('Save') }}</button>
</form>
