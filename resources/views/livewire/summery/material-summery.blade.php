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
                        @forelse ($materials as $material)
                        <option value="{{ $material->material_name }}">{{ $material->material_name }}</option>
                        @empty
                        @endforelse
                    </select>
                    {{-- <input placeholder="Enter project name:" class="form-control" wire:model.500ms="project_name">
                    <input placeholder="Enter material name:" class="form-control" wire:model.500ms="material_name"> --}}
                </div>
                <div class="card-footer">
                    Total quantity: {{ $total_quantity }}

                </div>
            </div>
        </div>

    </div>

    @livewire('material.material-history')


</div>