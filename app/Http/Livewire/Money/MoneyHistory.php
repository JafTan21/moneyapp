<?php

namespace App\Http\Livewire\Money;

use App\Constants\Constants;
use App\Models\Money;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class MoneyHistory extends Component
{
    use WithPagination;
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
    public $project_id;

    public function resetAll()
    {
        $this->in = 0;
        $this->out = 0;
        $this->of = null;
        $this->description = '';
        $this->project_id = '';

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
        $this->project_id = $money->project_id;
    }

    public function save()
    {
        if (!$this->project_id) {
            return;
        }
        Money::where('id', $this->editId)->first()->update([
            'in' => $this->in,
            'out' => $this->out,
            'of' => $this->of,
            'description' => $this->description,
            'project_id' => $this->project_id
        ]);

        $this->resetAll();
    }

    public function delete($id)
    {
        Money::where('id', $id)->firstOrFail()->delete();
    }

    public function render()
    {
        $data = Money::search($this->search, 'of')->myData()->with('project');
        $sum = $data;

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


        $data = $data->paginate(Constants::$pagination_count);
        return view('livewire.money.money-history', [
            'data' => $data,
            'totalDeposit' => $sum->sum('in'),
            'totalWithdraw' => $sum->sum('out')
        ]);
    }
}