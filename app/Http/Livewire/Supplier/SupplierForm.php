<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;

class SupplierForm extends Component
{
    public $success = '', $error = '';
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

        $this->success = '';
        $this->error = '';
    }

    public function save()
    {
        auth()->user()->suppliers()->create([
            'contact' => $this->contact,
            'company' => $this->company,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'product' => $this->product,
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