<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierHistory extends Component
{
    protected $listeners = [
        're-render-suppliers-history' => 'render'
    ];

    public $editId = '';
    public $search = '', $month = 'all', $year = '', $day = '';

    public $contact = '',
        $company = '',
        $mobile = '',
        $email = '',
        $product = '';

    public function resetAll()
    {
        $this->contact = '';
        $this->company = '';
        $this->mobile = '';
        $this->email = '';
        $this->product = '';

        $this->editId = '';
    }


    public function edit($id)
    {
        $this->editId = $id;
        $supplier = Supplier::where('id', $this->editId)->first();
        $this->contact = $supplier->contact;
        $this->company = $supplier->company;
        $this->mobile = $supplier->mobile;
        $this->email = $supplier->email;
        $this->product = $supplier->product;
    }

    public function save()
    {

        Supplier::where('id', $this->editId)->first()->update([
            'contact' => $this->contact,
            'company' => $this->company,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'product' => $this->product,
        ]);

        $this->resetAll();
    }

    public function delete($id)
    {
        Supplier::where('id', $id)->firstOrFail()->delete();
    }



    public function render()
    {
        $data = Supplier::search($this->search)->myData();

        if ($this->month != 'all') $data = $data->whereMonth('created_at', $this->month);
        if ($this->year != '') $data = $data->whereYear('created_at', $this->year);
        if ($this->day != '') $data = $data->whereDay('created_at', $this->day);

        return view('livewire.supplier.supplier-history', [
            'data' => $data->paginate(20)
        ]);
    }
}