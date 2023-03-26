<?php

namespace App\Http\Livewire\Labor;

use App\Constants\Constants;
use App\Exports\LaborExport;
use App\Models\Labor;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class LaborHistory extends Component
{
    use WithPagination;
    public $listeners = [
        're-render-labors-history' => 'render'
    ];
    public $editId = '';
    public $search = '';
    public $month = 'all';
    public $year = '';
    public $day = '';

    public $of = '';
    public $project_id = '';
    public $daily_worker = '';
    public $daily_foreman = '';
    public $construction_group = '';
    public $group_leader = '';
    public $daily_labor_payment = '';


    public function resetAll()
    {
        $this->of = '';
        $this->project_id = '';
        $this->daily_worker = '';
        $this->daily_foreman = '';
        $this->construction_group = '';
        $this->group_leader = '';
        $this->daily_labor_payment = '';

        $this->editId = '';
    }

    public function edit($id)
    {
        $this->editId = $id;
        $labor = Labor::where('id', $this->editId)->first();
        $this->of = Carbon::parse($labor->of)->format('Y-m-d');
        $this->project_id = $labor->project_id;
        $this->daily_worker = $labor->daily_worker;
        $this->daily_foreman = $labor->daily_foreman;
        $this->construction_group = $labor->construction_group;
        $this->group_leader = $labor->group_leader;
        $this->daily_labor_payment = $labor->daily_labor_payment;
    }

    public function save()
    {
        if (!$this->project_id) {
            return;
        }

        Labor::where('id', $this->editId)->first()->update([
            'of' => $this->of,
            'project_id' => $this->project_id,
            'daily_worker' => $this->daily_worker,
            'daily_foreman' => $this->daily_foreman,
            'construction_group' => $this->construction_group,
            'group_leader' => $this->group_leader,
            'daily_labor_payment' => $this->daily_labor_payment,
        ]);

        $this->resetAll();
    }

    public function delete($id)
    {
        Labor::where('id', $id)->firstOrFail()->delete();
    }


    public function render()
    {
        return view('livewire.labor.labor-history', [
            'data' => $this->getQuery()->paginate(Constants::$pagination_count)
        ]);
    }

    private function getQuery()
    {
        $query = Labor::search($this->search, 'of')->myData();

        if ($this->month != 'all') {
            $query = $query->whereMonth('of', $this->month);
        }
        if ($this->year != '') {
            $query = $query->whereYear('of', $this->year);
        }
        if ($this->day != '') {
            $query = $query->whereDay('of', $this->day);
        }


        return $query;
    }

    public function export()
    {
        return Excel::download(
            new LaborExport(
                $this->getQuery()
            ),
            'labor.xlsx'
        );
    }
}
