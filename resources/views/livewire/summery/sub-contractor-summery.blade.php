<div class="p-6 bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Sub contractor summery


                    <x-export-button />
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


                    <p>Construction group</p>
                    <select wire:model="constructionGroup">
                        <option value="">-- Select --</option>
                        @forelse ($groups as $group)
                        <option value="{{ $group->name }}">{{ $group->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="card-footer">
                    Total amount: {{ $total_amount }}
                </div>
            </div>
        </div>

    </div>

</div>