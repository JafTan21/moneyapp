<?php

namespace App\Http\Livewire\Labor;

use Livewire\Component;

class LaborForm extends Component
{
    public $success = '', $error = '';

    public $of = '',
        $project_id = '',
        $daily_worker = '',
        $daily_foreman = '',
        $construction_group = '',
        $group_leader = '',
        $daily_labor_payment = '';


    public function resetAll()
    {
        $this->of = '';
        $this->project_id = '';
        $this->daily_worker = '';
        $this->daily_foreman = '';
        $this->construction_group = '';
        $this->group_leader = '';
        $this->daily_labor_payment = '';
    }

    public function save()
    {
        if (!$this->of) {
            $this->success = '';
            $this->error = 'Date is required';
            return;
        }
        if (!$this->project_id) {
            $this->success = '';
            $this->error = 'Project is required';
            return;
        }

        auth()->user()->labors()->create([
            'of' => $this->of,
            'project_id' => $this->project_id,
            'daily_worker' => $this->daily_worker,
            'daily_foreman' => $this->daily_foreman,
            'construction_group' => $this->construction_group,
            'group_leader' => $this->group_leader,
            'daily_labor_payment' => $this->daily_labor_payment,
        ]);
        $this->success = 'Saved';
        $this->error = '';

        $this->resetAll();

        $this->emit('re-render-labors-history');
    }

    public function render()
    {
        return view('livewire.labor.labor-form');
    }
}