<div>

    @include('inc.success_error')

    <x-custom-input model="name" label="Name: " />
    <x-custom-input label="Start Date: " type="date" model="start" />
    <x-custom-input label="End Date: " type="date" model="end" />
    <x-custom-input label="Sponsor: " model="sponsor" />
    <x-custom-input label="Project value: " model="value" />
    <x-custom-input label="Project description: " model="description" />
    <x-custom-input label="Project progress: " model="progress" />
    <x-custom-input label="Status: " model="status" />

    <button class="btn btn-success" wire:click="save">
        Save
    </button>

</div>