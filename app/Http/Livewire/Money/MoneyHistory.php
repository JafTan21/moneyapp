<?php

namespace App\Http\Livewire\Money;

use App\Constants\Constants;
use App\Exports\MoneyExport;
use App\Models\Money;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class MoneyHistory extends Component
{
    use WithPagination;
    protected $listeners = [
        're-render-money-history' => 'render'
    ];

    // public $data = [];
    public $editId = '';

    public $search = '';
    public $month = 'all';
    public $year = '';
    public $day = '';

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
        return view('livewire.money.money-history', [
            'data' => $this->getQuery()->paginate(Constants::$pagination_count),
            'totalDeposit' => $this->getQuery()->sum('in'),
            'totalWithdraw' => $this->getQuery()->sum('out')
        ]);
    }

    private function getQuery()
    {
        $data = Money::search($this->search, 'of')->myData()->with('project');

        if ($this->month != 'all') {
            $data = $data->whereMonth('of', $this->month);
        }

        if ($this->year != '') {
            $data = $data->whereYear('of', $this->year);
        }

        if ($this->day != '') {
            $data = $data->whereDay('of', $this->day);
        }

        return $data;
    }

    public function export()
    {
        return Excel::download(
            new MoneyExport(
                $this->getQuery()
            ),
            'money.xlsx'
        );
    }
}
