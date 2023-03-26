<div>
    <div class="row">
        @include('inc.searchable')


    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <td># </td>
                <td>Date</td>
                <td>Project</td>
                <td>Construction Group</td>
                <td>Leader</td>
                <td>Payment</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $contract)

            @if ($editId == $contract->id)
            <tr>
                <td>
                    {{ $contract->id }}
                </td>
                <td>
                    <x-edit-input model="of" type="date" />
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
                    {{-- <x-edit-input model="construction_group" /> --}}
                    <select wire:model="construction_group">
                        <option value="0">-- Select --</option>
                        @forelse (\App\Models\ConstructionGroup::select('name')->get() as $cg)
                        <option value="{{ $cg->name }}">{{ $cg->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </td>
                <td>
                    <x-edit-input model="leader" />
                </td>
                <td>
                    <x-edit-input model="payment" />
                </td>
                <td>
                    <button class="btn  btn-success" wire:click="save({{ $contract->id }})">Save</button>
                </td>
            </tr>
            @else

            <tr>
                <td>
                    {{ $contract->id }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($contract->of)->toDateSTring() }}
                </td>
                <td>
                    {{ $contract->project->name }}
                </td>
                <td>
                    {{ $contract->construction_group }}
                </td>
                <td>
                    {{ $contract->leader }}
                </td>
                <td>
                    {{ $contract->payment }}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $contract->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $contract->id }})">
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