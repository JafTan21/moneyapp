<?php

namespace App\Http\Livewire\Bill;

use App\Models\Bill;
use Livewire\Component;

class BillHistory extends Component
{
    protected $listeners = [
        're-render-bills-history' => 'render'
    ];
    public $number = '',
        $project_id = '',
        $amount = '';

    public $editId = '';

    public $search = '', $month = 'all', $year = '', $day = '';


    public function resetAll()
    {
        $this->number = '';
        $this->project_id = '';
        $this->amount = '';

        $this->editId = '';
    }


    public function edit($id)
    {
        $this->editId = $id;
        $bill = Bill::where('id', $this->editId)->first();
        $this->number = $bill->number;
        $this->project_id = $bill->project_id;
        $this->amount = $bill->amount;
    }

    public function save()
    {
        Bill::where('id', $this->editId)->first()->update([
            'number' => $this->number,
            'project_id' => $this->project_id,
            'amount' => $this->amount,
        ]);

        $this->resetAll();
    }

    public function delete($id)
    {
        Bill::where('id', $id)->firstOrFail()->delete();
    }

    public function render()
    {
        $data = Bill::search($this->search)->myData();

        if ($this->month != 'all') $data = $data->whereMonth('created_at', $this->month);
        if ($this->year != '') $data = $data->whereYear('created_at', $this->year);
        if ($this->day != '') $data = $data->whereDay('created_at', $this->day);

        return view('livewire.bill.bill-history', [
            'data' => $data->paginate(20)
        ]);
    }
}