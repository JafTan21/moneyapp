<div>

    @include('inc.success_error')

    <x-input label="Name: " model="name" />
    <x-input label="Start Date: " type="date" model="start" />
    <x-input label="End Date: " type="date" model="end" />
    <x-input label="Sponsor: " model="sponsor" />
    <x-input label="Project value: " model="value" />
    <x-input label="Project description: " model="description" />
    <x-input label="Project progress: " model="progress" />
    <x-input label="Status: " model="status" />

    <button class="btn btn-success" wire:click="save">
        Save
    </button>

</div>