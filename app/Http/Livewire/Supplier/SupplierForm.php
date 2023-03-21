<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;

class SupplierForm extends Component
{
    public $success = '', $error = '';
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
        $this->material_id = '';

        $this->bill = '';
        $this->payment = '';
        $this->balance = '';

        $this->success = '';
        $this->error = '';
    }

    public function save()
    {
        auth()->user()->suppliers()->create([
            'contact' => $this->contact,
            // 'company' => $this->company,
            'mobile' => $this->mobile,
            // 'email' => $this->email,
            // 'product' => $this->product,
            // 'material_id' => $this->material_id,
            // 'bill' => $this->bill,
            'payment' => $this->payment,
            // 'balance' => $this->balance,
        ]);
        $this->success = 'Saved';
        $this->error = '';

        $this->resetAll();

        $this->emit('re-render-suppliers-history');

        $this->success = 'Saved';
    }

    public function render()
    {
        return view('livewire.supplier.supplier-form');
    }
}