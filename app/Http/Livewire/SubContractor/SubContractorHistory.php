<?php

namespace App\Http\Livewire\SubContractor;

use App\Models\SubContract;
use Livewire\Component;

class SubContractorHistory extends Component
{
    public $listeners = [
        're-render-sub-contracts-history' => 'render'
    ];

    public $editId = '';
    public $search = '', $month = 'all', $year = '', $day = '';

    public $of,
        $project_id,
        $construction_group,
        $leader,
        $payment;

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
        $this->of = $contract->of;
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
        $data = SubContract::search($this->search)->myData();

        if ($this->month != 'all') $data = $data->whereMonth('of', $this->month);
        if ($this->year != '') $data = $data->whereYear('of', $this->year);
        if ($this->day != '') $data = $data->whereDay('of', $this->day);


        return view('livewire.sub-contractor.sub-contractor-history', [
            'data' => $data->paginate(20)
        ]);
    }
}