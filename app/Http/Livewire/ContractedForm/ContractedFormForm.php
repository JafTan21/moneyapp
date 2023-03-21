<?php

namespace App\Http\Livewire\ContractedForm;

use Livewire\Component;

class ContractedFormForm extends Component
{
    public $success = '', $error = '';

    public
        $description = '',
        $unit_of_works = '',
        $quantity_of_work = '',
        $unit_rate = '',
        $completed_quantity = '',
        $total_amount = '',
        $project_id = '';


    public function resetAll()
    {
        $this->description = '';
        $this->unit_of_works = '';
        $this->quantity_of_work = '';
        $this->unit_rate = '';
        $this->completed_quantity = '';
        $this->total_amount = '';
        $this->project_id = '';
    }

    public function save()
    {
        auth()->user()->contracted()->create([
            'description' => $this->description,
            'unit_of_works' => $this->unit_of_works,
            'quantity_of_work' => $this->quantity_of_work,
            'unit_rate' => $this->unit_rate,
            'completed_quantity' => $this->completed_quantity,
            // 'total_amount' => $this->total_amount,
            'total_amount' => doubleval($this->unit_rate) * doubleval($this->completed_quantity),
            'project_id' => $this->project_id,
        ]);
        $this->success = 'Saved';
        $this->error = '';

        $this->resetAll();

        $this->emit('re-render-contracted-form-history');
    }


    public function render()
    {
        return view('livewire.contracted-form.contracted-form-form');
    }
}