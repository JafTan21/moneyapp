<?php

namespace App\Http\Livewire\Bill;

use Livewire\Component;

class BillForm extends Component
{
    public $success = '', $error = '';

    public $number = '',
        $project_id = '',
        $amount = '';

    public function resetAll()
    {
        $this->number = '';
        $this->project_id = '';
        $this->amount = '';
    }

    public function save()
    {
        if (!$this->amount) {
            $this->success = '';
            $this->error = 'Amount is required';
            return;
        }
        if (!$this->project_id) {
            $this->success = '';
            $this->error = 'Project is required';
            return;
        }

        auth()->user()->bills()->create([
            'number' => $this->number,
            'project_id' => $this->project_id,
            'amount' => $this->amount,
        ]);
        $this->success = 'Saved';
        $this->error = '';

        $this->resetAll();

        $this->emit('re-render-bills-history');
    }


    public function render()
    {
        return view('livewire.bill.bill-form');
    }
}