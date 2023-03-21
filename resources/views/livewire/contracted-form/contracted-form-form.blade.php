<div>
    @include('inc.success_error')


    <x-custom-input model="description" label="description: " />
    <x-custom-input model="unit_of_works" label="Unit of works" />
    <x-custom-input model="quantity_of_work" label="Quantity of work" />
    <x-custom-input model="unit_rate" label="Unit rate" type="number" />
    <x-custom-input model="completed_quantity" label="Completed quantity" type="number" />
    {{-- <x-custom-input model="total_amount" label="Total amount" type="number" /> --}}

    <div class="form-group my-3">
        <p>Project</p>
        <select wire:model="project_id">
            <option value="0">-- Select --</option>
            @forelse (\App\Models\Project::select('id', 'name')->get() as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
            @empty
            @endforelse
        </select>
    </div>


    <button class="btn btn-success" wire:click="save">
        Save
    </button>


</div>