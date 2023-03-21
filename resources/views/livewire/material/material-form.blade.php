<div>

    @include('inc.success_error')

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
    <x-custom-input model="of" label="Date: " type="date" />
    <div class="form-group my-3">
        <p>Material name</p>
        <select wire:model="material_name">
            <option value="0">-- Select --</option>
            @forelse (\App\Constants\Constants::MATERIAL_NAMES as $name)
            <option value="{{ $name }}">{{ $name }}</option>
            @empty
            @endforelse
        </select>
    </div>
    <div class="form-group my-3">
        <p>Material group</p>
        <select wire:model="material_group">
            <option value="0">-- Select --</option>
            @forelse (\App\Constants\Constants::MATERIAL_GROUPS as $name)
            <option value="{{ $name }}">{{ $name }}</option>
            @empty
            @endforelse
        </select>
    </div>
    {{-- <x-custom-input model="material_name" label="Material Name: " /> --}}
    <x-custom-input model="quantity" label="Quantity: " type="number" />
    <x-custom-input model="rate" label="Rate: " type="number" />
    <div class="form-group my-3">
        <p>Supplier</p>
        <select wire:model="supplier_id">
            <option value="0">-- Select --</option>
            @forelse (\App\Models\Supplier::select('id', 'contact')->get() as $supplier)
            <option value="{{ $supplier->id }}">{{ $supplier->contact }}</option>
            @empty
            @endforelse
        </select>
    </div>
    {{-- <x-custom-input model="transporation_cost" label="Transporation Cost: " type="number" />
    <x-custom-input model="labor_cost" label="Labor Cost: " type="number" /> --}}
    <div class="form-group my-3">
        <p>Unit</p>
        <select wire:model="unit">
            <option value="0">-- Select --</option>
            @forelse (\App\Constants\Constants::$units as $unit_)
            <option value="{{ $unit_ }}">{{ $unit_ }}</option>
            @empty
            @endforelse
        </select>
    </div>

    <button class="btn btn-success" wire:click="save">
        Save
    </button>

</div>