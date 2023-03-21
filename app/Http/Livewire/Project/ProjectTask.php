<?php

namespace App\Http\Livewire\Project;

use App\Models\ProjectTask as ModelsProjectTask;
use Carbon\Carbon;
use Livewire\Component;

class ProjectTask extends Component
{
    public $of,
        $name,
        $start_date,
        $end_date,
        $progress_rate,
        $status,
        $project_id, $edit_id = '';

    public $new_of,
        $new_name,
        $new_start_date,
        $new_end_date,
        $new_progress_rate,
        $new_status,
        $new_project_id;

    public function resetAll()
    {
        // $this->of = '';
        $this->name = '';
        $this->project_id = '';

        // $this->new_of = '';
        $this->new_name = '';
        $this->new_project_id = '';
        $this->new_start_date = '';
        $this->new_end_date = '';
        $this->new_progress_rate = '';
        $this->new_status = '';

        $this->edit_id = '';
    }

    public function render()
    {
        return view('livewire.project.project-task', [
            'tasks' => ModelsProjectTask::myData()->get()
        ]);
    }

    public function save_new()
    {
        ModelsProjectTask::create([
            // 'of' => $this->new_of,
            'name' => $this->new_name,
            'project_id' => $this->new_project_id,
            'user_id' => auth()->id(),

            'start_date' => $this->new_start_date,
            'end_date' => $this->new_end_date,
            'progress_rate' => $this->new_progress_rate,
            'status' => $this->new_status,
        ]);

        $this->resetAll();
    }

    public function edit($id)
    {
        $task = ModelsProjectTask::where('id', $id)->first();
        $this->edit_id = $task->id;

        $this->name = $task->name;
        $this->project_id  = $task->project_id;
        // $this->of = Carbon::parse($task->of)->format('Y-m-d');

        $this->start_date = Carbon::parse($task->start_date)->format('Y-m-d');
        $this->end_date = Carbon::parse($task->end_date)->format('Y-m-d');
        $this->progress_rate = $task->progress_rate;
        $this->status = $task->status;
    }

    public function delete($id)
    {
        $task = ModelsProjectTask::where('id', $id)->first();
        $task->delete();
    }

    public function save()
    {
        $task = ModelsProjectTask::where('id', $this->edit_id)->first();

        // $task->of = $this->of;
        $task->name = $this->name;
        $task->project_id  = $this->project_id;

        $task->start_date = $this->start_date;
        $task->end_date = $this->end_date;
        $task->progress_rate = $this->progress_rate;
        $task->status = $this->status;

        $task->save();

        $this->resetAll();
    }
}