<?php

namespace App\Http\Livewire\Supplier;

use App\Constants\Constants;
use App\Exports\SupplierExport;
use App\Models\Material;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SupplierHistory extends Component
{
    use WithPagination;
    protected $listeners = [
        're-render-suppliers-history' => 'render'
    ];

    public $editId = '';
    public $search = '';
    public $month = 'all';
    public $year = '';
    public $day = '';

    public $contact = '';
    // $company = '',
    public $mobile = '';
    // $email = '',
    // $product = '',
    public $material_id = '';
    public $bill = '';
    public $payment = '';
    public $balance = '';


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

        return view('livewire.supplier.supplier-history', [
            'data' => $this->getQuery()->paginate(Constants::$pagination_count)
        ]);
    }

    private function getQuery()
    {
        $data = Supplier::search($this->search)->myData()
            ->with([
                'materials' => function ($q) {
                    return $q->selectRaw('*, (rate * quantity) as bill');
                }
            ]);

        if ($this->month != 'all') {
            $data = $data->whereMonth('created_at', $this->month);
        }
        if ($this->year != '') {
            $data = $data->whereYear('created_at', $this->year);
        }
        if ($this->day != '') {
            $data = $data->whereDay('created_at', $this->day);
        }

        return $data;
    }

    public function export()
    {
        return Excel::download(
            new SupplierExport(
                $this->getQuery()
            ),
            'supplier.xlsx'
        );
    }
}
