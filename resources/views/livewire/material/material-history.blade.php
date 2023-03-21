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
                <td>Supplier</td>
                <td>Material Name</td>
                <td>Quantity</td>
                <td>Rate</td>
                {{-- <td>Transporation Cost</td>
                <td>Labor Cost</td> --}}
                <td>Unit</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $material)

            @if ($editId == $material->id)
            <tr>
                <td>
                    {{ $material->id }}
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
                    <select wire:model="supplier_id">
                        <option value="0">-- Select --</option>
                        @forelse (\App\Models\Supplier::select('id', 'contact')->get() as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->contact }}</option>
                        @empty
                        @endforelse
                    </select>
                </td>
                <td>
                    <select wire:model="material_name">
                        <option value="0">-- Select --</option>
                        @forelse (\App\Constants\Constants::MATERIAL_NAMES as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                        @empty
                        @endforelse
                    </select>

                    {{-- <x-edit-input model="material_name" /> --}}
                </td>
                <td>
                    <x-edit-input model="quantity" />
                </td>
                <td>
                    <x-edit-input model="rate" />
                </td>
                {{-- <td>
                    <x-edit-input model="transporation_cost" />
                </td>
                <td>
                    <x-edit-input model="labor_cost" />
                </td> --}}
                <td>
                    <select wire:model="unit">
                        <option value="0">-- Select --</option>
                        @forelse (\App\Constants\Constants::$units as $unit_)
                        <option value="{{ $unit_ }}">{{ $unit_ }}</option>
                        @empty
                        @endforelse
                    </select>
                </td>
                <td>
                    <button class="btn  btn-success" wire:click="save({{ $material->id }})">Save</button>
                </td>
            </tr>
            @else

            <tr>
                <td>
                    {{ $material->id }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($material->of)->toDateSTring() }}
                </td>
                <td>
                    {{ $material->project->name }}
                </td>
                <td>
                    {{ $material?->supplier?->contact }}
                </td>
                <td>
                    {{ $material->material_name }}
                </td>
                <td>
                    {{ $material->quantity }}
                </td>
                <td>
                    {{ $material->rate }}
                </td>
                {{-- <td>
                    {{ $material->transporation_cost }}
                </td>
                <td>
                    {{ $material->labor_cost }}
                </td> --}}
                <td>
                    {{ $material->unit }}
                </td>
                <td>
                    <button class="btn btn-sm btn-info" wire:click="edit({{ $material->id }})">Edit</button>
                    |
                    <button class="btn btn-sm btn-danger"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="delete({{ $material->id }})">
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