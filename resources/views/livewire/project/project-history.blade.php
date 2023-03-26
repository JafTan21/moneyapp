<div>
    <h6>Assign user to a project</h6>
    <div class="d-flex">
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
        <div class="form-group my-3">
            <p>User</p>
            <select wire:model="user_id">
                <option value="0">-- Select --</option>
                @forelse ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="form-group my-3">
            <button wire:click="assignProjectToUser" class="btn btn-success mt-4">Save</button>
        </div>
    </div>

    <div class="row mt-3">
        @include('inc.searchable')

        <x-export-button />

    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <td># </td>
                <td>Name</td>
                <td>Start</td>
                <td>End</td>
                <td>Sponsor</td>
                <td>Value</td>
                <td>Description</td>
                <td>Progress</td>
                <td>Status</td>
                <td>Users</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $project)

            @if ($editId == $project->id)
            <tr>
                <td>
                    {{ $project->id }}
                </td>
                <td>
                    <x-edit-input model="name" />
                </td>
                <td>
                    <x-edit-input model="start" type="date" />
                </td>
                <td>
                    <x-edit-input model="end" type="date" />
                </td>
                <td>
                    <x-edit-input model="sponsor" />
                </td>
                <td>
                    <x-edit-input model="value" />
                </td>
                <td>
                    <x-edit-input model="description" />
                </td>
                <td>
                    <x-edit-input model="progress" />
                </td>
                <td>
                    <x-edit-input model="status" />
                </td>
                <td>
                    <ol style="list-style-type: decimal">
                        @forelse ($project->viewers as $viewer)
                        <li>{{ $viewer->name }}
                            <a style="cursor: pointer" wire:click="remove_user({{ $viewer->id }}, {{ $project->id }})"
                                class="text-danger">Remove</a>
                        </li>
                        @empty
                        @endforelse
                    </ol>
                </td>
                <td>
                    <button class="btn  btn-success" wire:click="save({{ $project->id }})">Save</button>
                </td>
            </tr>
            @else

            <tr>
                <td>
                    {{ $project->id }}
                </td>
                <td>
                    {{ $project->name }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($project->start)->toDateSTring() }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($project->end)->toDateSTring() }}
                </td>
                <td>
                    {{ $project->sponsor }}
                </td>
                <td>
                    {{ $project->value }}
                </td>
                <td>
                    {{ $project->description }}
                </td>
                <td>
                    {{ $project->progress }}
                </td>
                <td>
                    {{ $project->status }}
                </td>
                <td>
                    <ol style="list-style-type: decimal">
                        @forelse ($project->viewers as $viewer)
                        <li>{{ $viewer->name }}</li>
                        @empty

                        @endforelse
                    </ol>
                </td>
                <td>
                    @if ($project->user_id == auth()->id() || auth()->user()->hasRole('admin'))
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $project->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $project->id }})">
                        Delete
                    </button>
                    @endif
                </td>
            </tr>
            @endif

            @endforeach
        </tbody>

    </table>
    {{ $data->links() }}
</div>