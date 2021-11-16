<div>
    @include('inc.success_error')

    <x-input model="of" label="Date" type="date" />
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
    <x-input model="daily_worker" label="Daily worker" type="number" />
    <x-input model="daily_foreman" label="Daily Foreman" type="number" />
    <x-input model="construction_group" label="Construction Group" />
    <x-input model="group_leader" label="Group Leader" />
    <x-input model="daily_labor_payment" label="Daily Labor Payment" type="number" />

    <button class="btn btn-success" wire:click="save">
        Save
    </button>


</div>