<?php

namespace App\Http\Livewire\Bill;

use App\Constants\Constants;
use App\Exports\BillExport;
use App\Models\Bill;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class BillHistory extends Component
{
    use WithPagination;
    protected $listeners = [
        're-render-bills-history' => 'render'
    ];
    public $number = '';
    public $project_id = '';
    public $amount = '';
    public $of = '';

    public $editId = '';

    public $search = '';
    public $month = 'all';
    public $year = '';
    public $day = '';


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
        return view('livewire.bill.bill-history', [
            'data' => $this->getQuery()->paginate(Constants::$pagination_count)
        ]);
    }

    private function getQuery()
    {
        $data = Bill::search($this->search)->myData();

        if ($this->month != 'all') {
            $data = $data->whereMonth('updated_at', $this->month);
        }
        if ($this->year != '') {
            $data = $data->whereYear('updated_at', $this->year);
        }
        if ($this->day != '') {
            $data = $data->whereDay('updated_at', $this->day);
        }


        return $data;
    }

    public function export()
    {
        return Excel::download(
            new BillExport(
                $this->getQuery()
            ),
            'bill.xlsx'
        );
    }
}
