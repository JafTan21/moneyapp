<div>

    @include('inc.success_error')

    <x-custom-input model="in" label="Deposit: " type="number" />
    <x-custom-input label="Withdraw: " model="out" type="number" />
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
    <x-custom-input label="Date: " model="of" type="date" />
    <x-custom-input label="Description: " model="description" />

    <button class="btn btn-success" wire:click="save">
        Save
    </button>
</div>