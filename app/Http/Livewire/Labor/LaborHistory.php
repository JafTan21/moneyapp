<?php

namespace App\Http\Livewire\Labor;

use App\Constants\Constants;
use App\Models\Labor;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class LaborHistory extends Component
{
    use WithPagination;
    public $listeners = [
        're-render-labors-history' => 'render'
    ];
    public $editId = '';
    public $search = '', $month = 'all', $year = '', $day = '';

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
        if (!$this->project_id) return;

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
        $data = Labor::search($this->search, 'of')->myData();

        if ($this->month != 'all') $data = $data->whereMonth('of', $this->month);
        if ($this->year != '') $data = $data->whereYear('of', $this->year);
        if ($this->day != '') $data = $data->whereDay('of', $this->day);

        return view('livewire.labor.labor-history', [
            'data' => $data->paginate(Constants::$pagination_count)
        ]);
    }
}