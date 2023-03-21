<?php

namespace App\Http\Livewire\Project;

use App\Constants\Constants;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectHistory extends Component
{
    use WithPagination;
    protected $listeners = [
        're-render-projects-history' => 'render'
    ];

    public $editId = '';
    public $search = '', $month = 'all', $year = '', $day = '';

    public $users;

    public function mount()
    {
        $this->users = User::select('id', 'name')->get();
    }

    public $project_id, $user_id;

    public $name,
        $start,
        $end,
        $sponsor,
        $value,
        $description,
        $progress,
        $status;

    public function resetAll()
    {
        $this->name = '';
        $this->start = '';
        $this->end = '';
        $this->sponsor = '';
        $this->value = '';
        $this->description = '';
        $this->progress = '';
        $this->status = '';

        $this->editId = '';
    }

    public function edit($id)
    {
        $this->editId = $id;
        $project = Project::where('id', $this->editId)->first();
        $this->name = $project->name;
        $this->start = Carbon::parse($project->start)->format('Y-m-d');
        $this->end =  Carbon::parse($project->end)->format('Y-m-d');
        $this->sponsor = $project->sponsor;
        $this->value = $project->value;
        $this->description = $project->description;
        $this->progress = $project->progress;
        $this->status = $project->status;
    }

    public function save()
    {
        if (!$this->editId) return;
        Project::where('id', $this->editId)->first()->update([
            'name' => $this->name,
            'start' => $this->start,
            'end' => $this->end,
            'sponsor' => $this->sponsor,
            'value' => $this->value,
            'progress' => $this->progress,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        $this->resetAll();
    }

    public function remove_user($user_id, $project_id)
    {
        ProjectUser::where('user_id', $user_id)
            ->where('project_id', $project_id)
            ->delete();
    }

    public function delete($id)
    {
        Project::where('id', $id)->firstOrFail()->delete();
    }

    public function assignProjectToUser()
    {
        if (!$this->project_id || !$this->user_id) return;

        ProjectUser::firstOrCreate(
            ['project_id' => $this->project_id, 'user_id' => $this->user_id],
            ['user_id', $this->user_id]
        );

        $this->project_id = '';
        $this->user_id = '';
    }


    public function render()
    {
        $data = Project::search($this->search);

        if (!auth()->user()->hasRole('admin')) {
            $ids = ProjectUser::where('user_id', auth()->id())->select('project_id')->get();
            $data = $data->where(function ($query) use ($ids) {
                return $query->myData()->orWhereIn('id', $ids);
            });
        }

        // dd($data->toSql());


        if ($this->month != 'all') $data = $data->whereMonth('start', $this->month);
        if ($this->year != '') $data = $data->whereYear('start', $this->year);
        if ($this->day != '') $data = $data->whereDay('start', $this->day);

        // $data = $data->paginate(40);

        return view('livewire.project.project-history', [
            'data' => $data->paginate(Constants::$pagination_count),
        ]);
    }
}