<?php

namespace App\Http\Livewire\ContractedForm;

use App\Constants\Constants;
use App\Models\ContractedForm;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ContractedFormHistory extends Component
{
    use WithPagination;
    public $listeners = [
        're-render-contracted-form-history' => 'render'
    ];
    public $editId = '';
    public $search = '', $month = 'all', $year = '', $day = '';

    public
        $description = '',
        $unit_of_works = '',
        $quantity_of_work = '',
        $unit_rate = '',
        $completed_quantity = '',
        $total_amount = '',
        $project_id = '';


    public function resetAll()
    {
        $this->description = '';
        $this->unit_of_works = '';
        $this->quantity_of_work = '';
        $this->unit_rate = '';
        $this->completed_quantity = '';
        $this->total_amount = '';
        $this->project_id = '';

        $this->editId = '';
    }

    public function edit($id)
    {
        $this->editId = $id;
        $contracted = ContractedForm::where('id', $this->editId)->first();
        $this->description = $contracted->description;
        $this->unit_of_works = $contracted->unit_of_works;
        $this->quantity_of_work = $contracted->quantity_of_work;
        $this->unit_rate = $contracted->unit_rate;
        $this->completed_quantity = $contracted->completed_quantity;
        $this->total_amount = $contracted->total_amount;
        $this->project_id = $contracted->project_id;
    }

    public function save()
    {
        if (!$this->project_id) return;

        ContractedForm::where('id', $this->editId)->first()->update([
            'description' => $this->description,
            'unit_of_works' => $this->unit_of_works,
            'quantity_of_work' => $this->quantity_of_work,
            'unit_rate' => $this->unit_rate,
            'completed_quantity' => $this->completed_quantity,
            // 'total_amount' => $this->total_amount,
            'total_amount' => doubleval($this->unit_rate) * doubleval($this->completed_quantity),
            'project_id' => $this->project_id,
        ]);
        $this->resetAll();
    }

    public function delete($id)
    {
        ContractedForm::where('id', $id)->firstOrFail()->delete();
    }


    public function render()
    {
        $data = ContractedForm::search($this->search, 'created_at')->myData();

        if ($this->month != 'all') $data = $data->whereMonth('created_at', $this->month);
        if ($this->year != '') $data = $data->whereYear('created_at', $this->year);
        if ($this->day != '') $data = $data->whereDay('created_at', $this->day);

        return view('livewire.contracted-form.contracted-form-history', [
            'data' => $data->paginate(Constants::$pagination_count)
        ]);
    }
}