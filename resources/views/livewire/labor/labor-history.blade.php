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
                <td>Daily worker</td>
                <td>Daily foreman</td>
                <td>Construction Group</td>
                <td>Group Leader</td>
                <td>Daily Labor Payment</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $labor)

            @if ($editId == $labor->id)
            <tr>
                <td>
                    {{ $labor->id }}
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
                    <x-edit-input model="daily_worker" type="number" />
                </td>
                <td>
                    <x-edit-input model="daily_foreman" type="number" />
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
                    <x-edit-input model="group_leader" />
                </td>
                <td>
                    <x-edit-input model="daily_labor_payment" />
                </td>
                <td>
                    <button class="btn  btn-success" wire:click="save({{ $labor->id }})">Save</button>
                </td>
            </tr>
            @else

            <tr>
                <td>
                    {{ $labor->id }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($labor->of)->toDateSTring() }}
                </td>
                <td>
                    {{ $labor->project->name }}
                </td>
                <td>
                    {{ $labor->daily_worker }}
                </td>
                <td>
                    {{ $labor->daily_foreman }}
                </td>
                <td>
                    {{ $labor->construction_group }}
                </td>
                <td>
                    {{ $labor->group_leader }}
                </td>
                <td>
                    {{ $labor->daily_labor_payment }}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $labor->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $labor->id }})">
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