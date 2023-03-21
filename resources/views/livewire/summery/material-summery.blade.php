<div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Material
                </div>
                <div class="card-body">
                    <p>Project name</p>
                    <select wire:model="projectName">
                        <option value="">-- Select --</option>
                        @forelse ($projects as $project)
                        <option value="{{ $project->name }}">{{ $project->name }}</option>
                        @empty
                        @endforelse
                    </select>

                    <p>Material name</p>
                    <select wire:model="materialName">
                        <option value="">-- Select --</option>
                        @forelse ($material_names as $material)
                        <option value="{{ $material->material_name }}">{{ $material->material_name }}</option>
                        @empty
                        @endforelse
                    </select>

                    <p>Material group</p>
                    <select wire:model="materialGroup">
                        <option value="">-- Select --</option>
                        @forelse ($material_groups as $material)
                        <option value="{{ $material->material_group }}">{{ $material->material_group }}</option>
                        @empty
                        @endforelse
                    </select>

                    <p>Supplier</p>
                    <select wire:model="supplier">
                        <option value="">-- Select --</option>
                        @forelse ($suppliers as $supplier)
                        <option value="{{ $supplier->contact }}">{{ $supplier->contact }}</option>
                        @empty
                        @endforelse
                    </select>


                </div>
                <div class="card-footer">
                    Total quantity: {{ $total_quantity }}

                </div>
            </div>
        </div>

    </div>

    @livewire('material.material-history')


</div>