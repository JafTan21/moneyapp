<?php

namespace App\Http\Livewire\SubContractor;

use App\Constants\Constants;
use App\Models\SubContract;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class SubContractorHistory extends Component
{
    use WithPagination;
    public $listeners = [
        're-render-sub-contracts-history' => 'render',
        'update-sub-contractors-history' => 'setValues'
    ];

    public $editId = '';
    public $search = '', $month = 'all', $year = '', $day = '';

    public $of,
        $project_id,
        $construction_group,
        $leader,
        $payment;

    public $project_name, $group;
    public function setValues($project_name, $group)
    {
        $this->project_name = $project_name;
        $this->group = $group;
    }

    public function resetAll()
    {
        $this->of = '';
        $this->project_id = '';
        $this->construction_group = '';
        $this->leader = '';
        $this->payment = '';

        $this->editId = '';
    }

    public function edit($id)
    {
        $this->editId = $id;
        $contract = SubContract::where('id', $this->editId)->first();
        $this->of = Carbon::parse($contract->of)->format('Y-m-d');
        $this->project_id = $contract->project_id;
        $this->construction_group = $contract->construction_group;
        $this->leader = $contract->leader;
        $this->payment = $contract->payment;
    }

    public function save()
    {
        if (!$this->project_id) return;

        SubContract::where('id', $this->editId)->first()->update([
            'of' => $this->of,
            'project_id' => $this->project_id,
            'construction_group' => $this->construction_group,
            'leader' => $this->leader,
            'payment' => $this->payment,
        ]);

        $this->resetAll();
    }

    public function delete($id)
    {
        SubContract::where('id', $id)->firstOrFail()->delete();
    }



    public function render()
    {
        $data = SubContract::search($this->search, 'of')->myData()->with('project');;

        if ($this->month != 'all') $data = $data->whereMonth('of', $this->month);
        if ($this->year != '') $data = $data->whereYear('of', $this->year);
        if ($this->day != '') $data = $data->whereDay('of', $this->day);

        if ($this->project_name) {
            $data = $data->whereHas('project', function ($query) {
                return $query->where('name', trim($this->project_name));
            });
        }
        if ($this->group) {
            $data  = $data->where('construction_group', trim($this->group));
        }

        return view('livewire.sub-contractor.sub-contractor-history', [
            'data' => $data->paginate(Constants::$pagination_count)
        ]);
    }

    public function refreshSummery()
    {
        $this->emit('set-date-values', $this->day, $this->month, $this->year);
    }

    public function updatedDay()
    {
        $this->refreshSummery();
    }
    public function updatedYear()
    {
        $this->refreshSummery();
    }
    public function updatedMonth()
    {
        $this->refreshSummery();
    }
}