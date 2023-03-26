<div>
    <div class="row">
        @include('inc.searchable')

        <x-export-button />
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <td># </td>
                <td>description</td>
                <td>unit of works</td>
                <td>quantity of work</td>
                <td>unit rate</td>
                <td>completed quantity</td>
                <td>total amount</td>
                <td>project</td>
                <td>actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $contracted)

            @if ($editId == $contracted->id)
            <tr>
                <td>
                    {{ $contracted->id }}
                </td>
                <td>
                    <x-edit-input model="description" />
                </td>
                <td>
                    <x-edit-input model="unit_of_works" />
                </td>
                <td>
                    <x-edit-input model="quantity_of_work" />
                </td>
                <td>
                    <x-edit-input model="unit_rate" />
                </td>
                <td>
                    <x-edit-input model="completed_quantity" type="number" />
                </td>
                <td>
                    {{ doubleval($this->unit_rate) * doubleval($this->completed_quantity) }}
                    {{-- <x-edit-input model="total_amount" type="number" /> --}}
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
                    <button class="btn  btn-success" wire:click="save({{ $contracted->id }})">Save</button>
                </td>
            </tr>
            @else

            <tr>
                <td>
                    {{ $contracted->id }}
                </td>
                <td>
                    {{ $contracted->description }}
                </td>
                <td>
                    {{ $contracted->unit_of_works }}
                </td>
                <td>
                    {{ $contracted->quantity_of_work }}
                </td>
                <td>
                    {{ $contracted->unit_rate }}
                </td>
                <td>
                    {{ $contracted->completed_quantity }}
                </td>
                <td>
                    {{ $contracted->total_amount }}
                </td>
                <td>
                    {{ $contracted->project->name }}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $contracted->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $contracted->id }})">
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