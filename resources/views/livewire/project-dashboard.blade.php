<div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Project
                </div>
                <div class="card-body">
                    <select wire:model="project_id">
                        <option value="0">-- Select --</option>
                        @forelse (\App\Models\Project::get() as $project_)
                        <option value="{{ $project_->id }}">{{ $project_->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
        </div>
        @if ($project)
        <div class="col-md-3">
            <p>Project cost: {{ $project->value }} bdt</p>
            <p>Project Expense: {{ $project->monies()->sum('out') }} bdt</p>
            <p>Project Deposit: {{ $project->monies()->sum('in') }} bdt</p>
        </div>
        <div class="col-md-3">
            <p>Project duration:</p>
            <p>
                @if ($project->start)
                {{ \Carbon\Carbon::parse($project->start)->toDateString() }}
                @endif
                -
                @if ($project->end)
                {{ \Carbon\Carbon::parse($project->end)->toDateString() }}
                @endif


                @if ($project->start && $project->end)

                <br> (
                {{ \Carbon\Carbon::parse($project->start)->diffInDays(now()) }} /
                {{
                \Carbon\Carbon::parse($project->start)->diffInDays(\Carbon\Carbon::parse($project->end))
 }} days)
                @endif

            </p>
        </div>
        @endif
    </div>

    @if ($project)
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Project Work Status
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Project Completion %
                </div>
                <div class="card-body">
                    {{ $project->progress }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Project Stage
                </div>
                <div class="card-body">

                    {{ $project->status }}
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Project Total Resource
                </div>
                <div class="card-body">
                    Total Foreman: {{ $project->labors->sum('daily_foreman') ?? 0 }} <br>
                    Total Worker: {{ $project->labors->sum('daily_worker') ?? 0 }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Todays Resource
                </div>
                <div class="card-body">
                    Daily Foreman: {{ $project->todays_labors->sum('daily_foreman') ?? 0 }} <br>
                    Daily Worker: {{ $project->todays_labors->sum('daily_worker') ?? 0 }}
                </div>
            </div>
        </div>

    </div>
    @endif
</div>