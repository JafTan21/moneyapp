<div>

    @include('inc.success_error')

    <x-input label="Deposit: " model="in" />
    <x-input label="Withdraw: " model="out" />
    <x-input label="Date: " model="of" type="date" />
    <x-input label="Description: " model="description" />

    <button class="btn btn-success" wire:click="save">
        Save
    </button>
</div>