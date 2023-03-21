<?php

namespace App\Http\Livewire\Material;

use Livewire\Component;

class MaterialForm extends Component
{
    public $success = '';
    public $error = '';

    public $of;
    public $project_id;
    public $material_name;
    public $material_group;
    public $quantity;
    public $supplier_id;
    public $transporation_cost;
    public $labor_cost;
    public $unit;
    public $rate;

    public function resetAll()
    {
        $this->of = '';
        $this->project_id = '';
        $this->material_name = '';
        $this->material_group = '';
        $this->quantity = '';
        $this->supplier_id = '';
        // $this->transporation_cost = '';
        // $this->labor_cost = '';
        $this->unit = '';
        $this->rate = '';
    }

    public function save()
    {
        if (!$this->project_id) {
            $this->success = '';
            $this->error = 'Project is required';
            return;
        }
        // if (!$this->supplier_id) {
        //     $this->success = '';
        //     $this->error = 'Supplier is required';
        //     return;
        // }
        auth()->user()->materials()->create([
            'of' => $this->of,
            'project_id' => $this->project_id,
            'material_name' => $this->material_name,
            'material_group' => $this->material_group,
            'quantity' => $this->quantity,
            'supplier_id' => $this->supplier_id,
            // 'transporation_cost' => $this->transporation_cost,
            // 'labor_cost' => $this->labor_cost,
            'unit' => $this->unit,
            'rate' => $this->rate,
        ]);
        $this->success = 'Saved';
        $this->error = '';

        $this->resetAll();

        $this->emit('re-render-material-history');
    }

    public function render()
    {
        return view('livewire.material.material-form');
    }
}
