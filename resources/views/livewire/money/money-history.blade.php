<div>
    <div class="row">
        @include('inc.searchable')
        <div class="col-md-3">
            <p>Total deposit: {{ $totalDeposit }}</p>
            <p>Total withdraw: {{ $totalWithdraw}}</p>
            <p>Total saving: {{ $totalDeposit -$totalWithdraw }}</p>
        </div>

        <button class="btn btn-info text-white" wire:click="export">
            Export
        </button>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <td>#</td>
                <td>Date</td>
                <td>Project</td>
                <td>Deposit</td>
                <td>Withdraw</td>
                <td>Description</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $money)

            @if ($editId == $money->id)
            <tr>
                <td>
                    {{ $money->id }}
                </td>
                <td>
                    <input wire:model="of" class="form-control" type="date" />
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
                    <input wire:model="in" class="form-control" type="text" />
                </td>
                <td>
                    <input wire:model="out" class="form-control" type="text" />
                </td>
                <td>
                    <input wire:model="description" class="form-control" type="text" />
                </td>
                <td>
                    <button class="btn  btn-success" wire:click="save({{ $money->id }})">Save</button>
                </td>
            </tr>
            @else

            <tr>
                <td>
                    {{ $money->id }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($money->of)->toDateSTring() }}
                </td>
                <td>
                    {{ $money->project->name }}
                </td>
                <td>
                    {{ $money->in }}
                </td>
                <td>
                    {{ $money->out }}
                </td>
                <td>
                    {{ $money->description }}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $money->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $money->id }})">
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