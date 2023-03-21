<div>
    @include('inc.success_error')

    <x-custom-input model="of" label="Date: " type="date" />
    <x-custom-input model="number" label="Number" />

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
    <x-custom-input model="amount" label="Amount" type="number" />


    <button class="btn btn-success" wire:click="save">
        Save
    </button>


</div>