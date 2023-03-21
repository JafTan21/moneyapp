<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\ProjectUser;
use Livewire\Component;

class ProjectDashboard extends Component
{

    public $project_id;

    public function render()
    {

        return view('livewire.project-dashboard', [
            'project' => Project::where('id', $this->project_id)
                ->with(['labors', 'todays_labors'])
                ->first()
        ]);
    }
}