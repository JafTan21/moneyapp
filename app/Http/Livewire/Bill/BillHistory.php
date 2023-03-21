<?php

namespace App\Http\Livewire\Bill;

use App\Constants\Constants;
use App\Models\Bill;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class BillHistory extends Component
{
    use WithPagination;
    protected $listeners = [
        're-render-bills-history' => 'render'
    ];
    public $number = '',
        $project_id = '',
        $amount = '',
        $of = '';

    public $editId = '';

    public $search = '', $month = 'all', $year = '', $day = '';


    public function resetAll()
    {
        $this->number = '';
        $this->project_id = '';
        $this->amount = '';
        $this->of = '';

        $this->editId = '';
    }


    public function edit($id)
    {
        $this->editId = $id;
        $bill = Bill::where('id', $this->editId)->first();
        $this->number = $bill->number;
        $this->project_id = $bill->project_id;
        $this->amount = $bill->amount;
        $this->of = Carbon::parse($bill->updated_at)->format('Y-m-d');
    }

    public function save()
    {
        Bill::where('id', $this->editId)->first()->update([
            'number' => $this->number,
            'project_id' => $this->project_id,
            'amount' => $this->amount,
            'updated_at' => $this->of
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

        if ($this->month != 'all') $data = $data->whereMonth('updated_at', $this->month);
        if ($this->year != '') $data = $data->whereYear('updated_at', $this->year);
        if ($this->day != '') $data = $data->whereDay('updated_at', $this->day);

        return view('livewire.bill.bill-history', [
            'data' => $data->paginate(Constants::$pagination_count)
        ]);
    }
}