<?php

namespace App\Http\Livewire\Supplier;

use App\Constants\Constants;
use App\Models\Material;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierHistory extends Component
{
    use WithPagination;
    protected $listeners = [
        're-render-suppliers-history' => 'render'
    ];

    public $editId = '';
    public $search = '', $month = 'all', $year = '', $day = '';

    public $contact = '',
        // $company = '',
        $mobile = '',
        // $email = '',
        // $product = '',
        $material_id = '',
        $bill = '',
        $payment = '',
        $balance = '';


    public function resetAll()
    {
        $this->contact = '';
        // $this->company = '';
        $this->mobile = '';
        // $this->email = '';
        // $this->product = '';
        // $this->material_id = '';

        $this->bill = '';
        $this->payment = '';
        $this->balance = '';

        $this->editId = '';
    }


    public function edit($id)
    {
        $this->editId = $id;
        $supplier = Supplier::where('id', $this->editId)->first();
        $this->contact = $supplier->contact;
        // $this->company = $supplier->company;
        $this->mobile = $supplier->mobile;
        // $this->email = $supplier->email;
        // $this->product = $supplier->product;
        // $this->material_id = $supplier->material_id;

        $this->bill = $supplier->bill;
        $this->payment = $supplier->payment;
        $this->balance = $supplier->balance;
    }

    public function save()
    {

        Supplier::where('id', $this->editId)->first()->update([
            'contact' => $this->contact,
            // 'company' => $this->company,
            'mobile' => $this->mobile,
            // 'email' => $this->email,
            // 'product' => $this->product,
            // 'material_id' => $this->material_id,

            'bill' => $this->bill,
            'payment' => $this->payment,
            'balance' => $this->balance,
        ]);

        $this->resetAll();
    }

    public function delete($id)
    {
        Supplier::where('id', $id)->firstOrFail()->delete();
    }



    public function render()
    {
        unset(
            Material::$searchables[array_search("project_id", Material::$searchables)]
        );
        $data = Supplier::search($this->search)->myData()
            ->with([
                'materials' => function ($q) {
                    return $q->selectRaw('*, (rate * quantity) as bill');
                }
            ]);
        // ->selectRaw('SUM(quantity * rate) as bill');

        if ($this->month != 'all') $data = $data->whereMonth('created_at', $this->month);
        if ($this->year != '') $data = $data->whereYear('created_at', $this->year);
        if ($this->day != '') $data = $data->whereDay('created_at', $this->day);

        return view('livewire.supplier.supplier-history', [
            'data' => $data
                ->paginate(Constants::$pagination_count)
        ]);
    }
}