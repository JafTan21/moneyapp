<?php

namespace App\Http\Livewire\Money;

use App\Models\Money;
use Carbon\Carbon;
use Livewire\Component;

class MoneyHistory extends Component
{
    protected $listeners = [
        're-render-money-history' => 'render'
    ];

    // public $data = [];
    public $editId = '';

    public $search = '', $month = 'all', $year = '', $day = '';

    public $in;
    public $out;
    public $of;
    public $description;

    public function resetAll()
    {
        $this->in = 0;
        $this->out = 0;
        $this->of = null;
        $this->description = '';

        $this->editId = null;
    }

    public function edit($id)
    {
        $this->editId = $id;
        $money = Money::where('id', $this->editId)->first();
        $this->in = $money->in;
        $this->out = $money->out;
        $this->of = Carbon::parse($money->of)->format('Y-m-d');
        $this->description = $money->description;
    }

    public function save()
    {
        Money::where('id', $this->editId)->first()->update([
            'in' => $this->in,
            'out' => $this->out,
            'of' => $this->of,
            'description' => $this->description
        ]);

        $this->resetAll();
    }

    public function delete($id)
    {
        Money::where('id', $id)->firstOrFail()->delete();
    }

    public function render()
    {
        $data = Money::search($this->search)->myData();
        $sum = Money::myData();

        if ($this->month != 'all') {
            $data = $data->whereMonth('of', $this->month);
            $sum = $sum->whereMonth('of', $this->month);
        }

        if ($this->year != '') {
            $data = $data->whereYear('of', $this->year);
            $sum = $sum->whereYear('of', $this->year);
        }

        if ($this->day != '') {
            $data = $data->whereDay('of', $this->day);
            $sum = $sum->whereDay('of', $this->day);
        }

        $data = $data->paginate(40);
        return view('livewire.money.money-history', [
            'data' => $data,
            'totalDeposit' => $sum->sum('in'),
            'totalWithdraw' => $sum->sum('out')
        ]);
    }
}