<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;

class ProjectForm extends Component
{
    public $success = '', $error = '';

    public $name,
        $start,
        $end,
        $sponsor,
        $value,
        $description,
        $progress,
        $status;

    public function mount()
    {
        $this->name = '';
        $this->start = '';
        $this->end = '';
        $this->sponsor = '';
        $this->value = '';
        $this->description = '';
        $this->progress = '';
        $this->status = '';
    }

    public function save()
    {
        if (!$this->name) {
            $this->success = '';
            $this->error = 'Name is required';
            return;
        }
        auth()->user()->projects()->create([
            'name' => $this->name,
            'start' => $this->start,
            'end' => $this->end,
            'sponsor' => $this->sponsor,
            'value' => $this->value,
            'description' => $this->description,
            'progress' => $this->progress,
            'status' => $this->status,
        ]);
        $this->success = 'Saved';
        $this->error = '';

        $this->mount();

        $this->emit('re-render-projects-history');
    }

    public function render()
    {
        return view('livewire.project.project-form');
    }
}