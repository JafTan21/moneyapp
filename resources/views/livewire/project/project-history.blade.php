<div>
    <div class="row">
        @include('inc.searchable')
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
                <td>Status</td>
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
                    <x-edit-input model="status" />
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
                    {{ $project->status }}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $project->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $project->id }})">
                        Delete
                    </button>
                </td>
            </tr>
            @endif

            @endforeach
        </tbody>

    </table>
    {{ $data->links() }}
</div>