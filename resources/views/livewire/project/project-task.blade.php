<div class="mt-4">
    <b>Project Task</b>

    <div class="row">
        <div class="col-md-4">
            <span>start date</span>
            <x-edit-input model="new_start_date" type="date" />
        </div>
        <div class="col-md-4">
            <span>end date</span>
            <x-edit-input model="new_end_date" type="date" />
        </div>
        <div class="col-md-4">
            <span>name</span>
            <x-edit-input model="new_name" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 d-flex flex-col">
            <span>project</span>
            <select wire:model="new_project_id">
                <option value="0">-- Select Project --</option>
                @forelse (\App\Models\Project::select('id', 'name')->get() as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-md-4">
            <span>progress rate</span>
            <x-edit-input model="new_progress_rate" />
        </div>
        <div class="col-md-4 d-flex flex-col">
            <span>status</span>
            <select wire:model="new_status">
                <option value="0">-- Select Status --</option>
                @forelse (\App\Models\ProjectTask::Statuses as $status)
                <option value="{{ $status }}">{{ $status }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <button class="btn btn-success" wire:click="save_new()">Save</button>
            </div>
        </div>
    </div>



    <table class="table mt-3">

        <thead>
            <tr>
                <td>#</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Name</td>
                <td>Project</td>
                <td>Progress rate</td>
                <td>status</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>

            @foreach ($tasks as $task)

            @if ($edit_id == $task->id)
            <tr>
                <td>
                    {{ $task->id }}
                </td>
                <td>
                    <x-edit-input model="start_date" type="date" />
                    {{-- <x-edit-input model="of" type="date" /> --}}
                </td>
                <td>
                    <x-edit-input model="end_date" type="date" />
                </td>
                <td>
                    <x-edit-input model="name" />
                </td>
                <td>
                    <select wire:model="project_id">
                        <option value="0">-- Select --</option>
                        @forelse (\App\Models\Project::select('id', 'name')->get() as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </td>
                <td>
                    <x-edit-input model="progress_rate" />
                </td>
                <td>
                    <select wire:model="status">
                        <option value="0">-- Select Status --</option>
                        @forelse (\App\Models\ProjectTask::Statuses as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                        @empty
                        @endforelse
                    </select>
                </td>
                <td>
                    <button class="btn btn-success" wire:click="save()">Save</button>
                </td>
            </tr>
            @else
            <tr>
                <td>
                    {{ $task->id }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($task->start_date)->toDateSTring() }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($task->end_date)->toDateSTring() }}
                </td>
                <td>
                    {{ $task->name }}
                </td>
                <td>
                    {{ $task->project->name }}
                </td>
                <td>
                    {{ $task->progress_rate }}
                </td>
                <td>
                    {{ $task->status }}
                </td>
                <td>
                    <button class="btn btn-info" wire:click="edit({{ $task->id }})">Edit</button> |
                    <button class="btn btn-danger"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $task->id }})">Delete</button>
                </td>
            </tr>
            @endif

            @endforeach
        </tbody>
    </table>
</div>