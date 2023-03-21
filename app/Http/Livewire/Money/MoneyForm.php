<?php

namespace App\Http\Livewire\Money;

use App\Models\Money;
use Livewire\Component;

class MoneyForm extends Component
{
    public $in;
    public $out;
    public $of;
    public $description;
    public $project_id;

    public $success, $error;

    public function mount()
    {
        $this->in = 0;
        $this->out = 0;
        $this->of =     now();
        $this->description = '';
        $this->project_id = '';
    }

    public function save()
    {
        if (!$this->in && !$this->out) {
            $this->success = '';
            $this->error = 'Deposit or Withdraw can not be empty';
            return;
        }

        if (!$this->project_id) {
            $this->success = '';
            $this->error = 'Please select a project';
            return;
        }

        auth()->user()->monies()->create([
            'in' => $this->in,
            'out' => $this->out,
            'of' => $this->of,
            'description' => $this->description,
            'project_id' => $this->project_id
        ]);

        $this->in = 0;
        $this->out = 0;
        $this->of =  null;
        $this->description = '';
        $this->project_id = '';

        $this->success = 'Saved...';
        $this->error = '';

        $this->emit('re-render-money-history');
    }

    public function render()
    {
        return view('livewire.money.money-form');
    }
}