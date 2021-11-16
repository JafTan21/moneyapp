<?php

namespace App\Http\Livewire\SubContractor;

use Livewire\Component;

class SubContractorForm extends Component
{
    public $success, $error;

    public $of,
        $project_id,
        $construction_group,
        $leader,
        $payment;

    public function resetAll()
    {
        $this->of = '';
        $this->project_id = '';
        $this->construction_group = '';
        $this->leader = '';
        $this->payment = '';
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
        auth()->user()->sub_contracts()->create([
            'of' => $this->of,
            'project_id' => $this->project_id,
            'construction_group' => $this->construction_group,
            'leader' => $this->leader,
            'payment' => $this->payment,
        ]);
        $this->success = 'Saved';
        $this->error = '';

        $this->resetAll();
        $this->emit('re-render-sub-contracts-history');
    }


    public function render()
    {
        return view('livewire.sub-contractor.sub-contractor-form');
    }
}