<div class="form-group my-3">
    <p>{{ $label }}</p>
    <input type="{{ $type }}" class="form-control" wire:model.lazy="{{ $model }}">
</div>