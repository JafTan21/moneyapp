<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Carbon\Carbon;
use Livewire\Component;

class ProjectHistory extends Component
{
    protected $listeners = [
        're-render-projects-history' => 'render'
    ];

    public $editId = '';
    public $search = '', $month = 'all', $year = '', $day = '';

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
        Project::where('id', $this->editId)->first()->update([
            'name' => $this->name,
            'start' => $this->start,
            'end' => $this->end,
            'sponsor' => $this->sponsor,
            'value' => $this->value,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        $this->resetAll();
    }

    public function delete($id)
    {
        Project::where('id', $id)->firstOrFail()->delete();
    }


    public function render()
    {
        $data = Project::search($this->search)->myData();

        if ($this->month != 'all') $data = $data->whereMonth('start', $this->month);
        if ($this->year != '') $data = $data->whereYear('start', $this->year);
        if ($this->day != '') $data = $data->whereDay('start', $this->day);

        // $data = $data->paginate(40);

        return view('livewire.project.project-history', [
            'data' => $data->paginate(20),
        ]);
    }
}