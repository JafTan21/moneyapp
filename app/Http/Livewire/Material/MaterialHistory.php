<?php

namespace App\Http\Livewire\Material;

use App\Constants\Constants;
use App\Models\Material;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class MaterialHistory extends Component
{
    use WithPagination;
    public $listeners = [
        're-render-material-history' => 'render',
        'update-material-history' => 'setValues'
    ];

    public $editId = '';
    public $search = '';
    public $month = 'all';
    public $year = '';
    public $day = '';

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

    public $material_group_search;
    public $material_name_search;
    public $supplier;
    public $project;

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

        $this->editId = '';
    }

    public function edit($id)
    {
        $this->editId = $id;
        $material = Material::where('id', $this->editId)->first();
        $this->of = Carbon::parse($material->of)->format('Y-m-d');
        $this->project_id = $material->project_id;
        $this->material_name = $material->material_name;
        $this->material_group = $material->material_group;
        $this->quantity = $material->quantity;
        $this->supplier_id = $material->supplier_id;
        // $this->transporation_cost = $material->transporation_cost;
        // $this->labor_cost = $material->labor_cost;
        $this->unit = $material->unit;
        $this->rate = $material->rate;
    }


    public function save()
    {
        if (!$this->project_id || !$this->editId) {
            return;
        }

        Material::where('id', $this->editId)->update([
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

        $this->resetAll();
    }

    public function delete($id)
    {
        Material::where('id', $id)->firstOrFail()->delete();
    }

    public function setValues($project, $material_name, $material_group, $supplier)
    {
        $this->project = $project;
        $this->material_name_search = $material_name;
        $this->material_group_search = $material_group;
        $this->supplier = $supplier;
    }


    public function render()
    {
        $data = Material::search($this->search, 'of')->myData()
            ->with([
                'project',
                'supplier',
            ]);

        if ($this->project) {
            $data = $data->whereHas('project', function ($query) {
                return $query->where('name', trim($this->project));
            });
        }
        if ($this->supplier) {
            $data = $data->whereHas('supplier', function ($query) {
                return $query->where('contact', trim($this->supplier));
            });
        }
        if ($this->material_name_search) {
            $data = $data->where('material_name', trim($this->material_name_search));
        }
        if ($this->material_group_search) {
            $data = $data->where('material_group', trim($this->material_group_search));
        }

        if ($this->month != 'all') {
            $data = $data->whereMonth('of', $this->month);
        }
        if ($this->year != '') {
            $data = $data->whereYear('of', $this->year);
        }
        if ($this->day != '') {
            $data = $data->whereDay('of', $this->day);
        }

        return view('livewire.material.material-history', [
            'data' => $data->with(['supplier'])->paginate(Constants::$pagination_count),
        ]);
    }

    private function refreshSummery()
    {
        $this->emit('set-date-values', $this->day, $this->month, $this->year);
    }

    public function updatedDay()
    {
        $this->refreshSummery();
    }
    public function updatedYear()
    {
        $this->refreshSummery();
    }
    public function updatedMonth()
    {
        $this->refreshSummery();
    }
}
