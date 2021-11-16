<div>
    <div class="row">
        @include('inc.searchable')
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <td># </td>
                <td>Number</td>
                <td>Project</td>
                <td>Amount</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $bill)

            @if ($editId == $bill->id)
            <tr>
                <td>
                    {{ $bill->id }}
                </td>
                <td>
                    <x-edit-input model="number" />
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
                    <x-edit-input model="amount" type="number" />
                </td>
                <td>
                    <button class="btn  btn-success" wire:click="save({{ $bill->id }})">Save</button>
                </td>
            </tr>
            @else

            <tr>
                <td>
                    {{ $bill->id }}
                </td>
                <td>
                    {{ $bill->number }}
                </td>
                <td>
                    {{ $bill->project->name }}
                </td>
                <td>
                    {{ $bill->amount }}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $bill->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $bill->id }})">
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