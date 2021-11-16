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

    public $success, $error;

    public function mount()
    {
        $this->in = 0;
        $this->out = 0;
        $this->of =     now();
        $this->description = '';
    }

    public function save()
    {
        if (!$this->in && !$this->out) {
            $this->success = '';
            $this->error = 'Deposit or Withdraw can not be empty';
            return;
        }

        auth()->user()->monies()->create([
            'in' => $this->in,
            'out' => $this->out,
            'of' => $this->of,
            'description' => $this->description
        ]);

        $this->in = 0;
        $this->out = 0;
        $this->of =  null;
        $this->description = '';

        $this->success = 'Saved...';
        $this->error = '';

        $this->emit('re-render-money-history');
    }

    public function render()
    {
        return view('livewire.money.money-form');
    }
}