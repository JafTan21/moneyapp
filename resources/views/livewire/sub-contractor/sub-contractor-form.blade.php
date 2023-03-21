<div>
    @include('inc.success_error')

    <x-custom-input model="of" label="Date" type="date" />
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
    {{-- <x-custom-input model="construction_group" label="Construction Group" /> --}}
    <div class="form-group my-3">
        <p>Construction Group</p>
        <select wire:model="construction_group">
            <option value="0">-- Select --</option>
            @forelse (\App\Models\ConstructionGroup::select('name')->get() as $cg)
            <option value="{{ $cg->name }}">{{ $cg->name }}</option>
            @empty
            @endforelse
        </select>
    </div>

    <x-custom-input model="leader" label="Leader" />
    <x-custom-input model="payment" label="Payment" type="number" />

    <button class="btn btn-success" wire:click="save">
        Save
    </button>


</div>