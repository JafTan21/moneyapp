<?php

namespace App\Http\Livewire\Summery;

use App\Models\Material;
use App\Models\Project;
use App\Models\Supplier;
use Livewire\Component;

class MaterialSummery extends Component
{
    public $materialName;
    public $materialGroup;
    public $projectName;
    public $supplier;

    protected $listeners = [
        'set-date-values' => 'setDates'
    ];

    public int $i = 0;

    public $day = null;
    public $month = "all";
    public $year = null;
    public function setDates($day, $month, $year)
    {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }


    public function render()
    {
        $total = Material::query()->myData();

        if ($this->materialName) {
            $total = $total->where('material_name', trim($this->materialName));
        }
        if ($this->materialGroup) {
            $total = $total->where('material_group', trim($this->materialGroup));
        }
        if ($this->supplier) {
            $total = $total->whereHas('supplier', function ($query) {
                return $query->where('contact', trim($this->supplier));
            });
        }
        if ($this->projectName) {
            $total = $total->whereHas('project', function ($query) {
                return $query->where('name', trim($this->projectName));
            });
        }



        if ($this->month != 'all') {
            $total = $total->whereMonth('of', $this->month);
        }
        if ($this->year != '') {
            $total = $total->whereYear('of', $this->year);
        }
        if ($this->day != '') {
            $total = $total->whereDay('of', $this->day);
        }

        $total = $total->sum('quantity');

        // $this->emit('update-material-history', $this->projectName, $this->materialName);
        $this->i++;
        return view('livewire.summery.material-summery', [
            'total_quantity' => $total,
            'projects' => Project::select('name')->distinct()->myData()->get(),
            'material_names' => Material::select('material_name')->distinct()->myData()->get(),
            'material_groups' => Material::select('material_group')->distinct()->myData()->get(),
            'suppliers' => Supplier::select('contact')->distinct()->myData()->get(),
        ]);
    }

    public function refreshHistory()
    {
        $this->emit('update-material-history', $this->projectName, $this->materialName, $this->materialGroup, $this->supplier);
    }
    public function updatedProjectName($value)
    {
        $this->refreshHistory();
    }
    public function updatedMaterialName($value)
    {
        $this->refreshHistory();
    }
    public function updatedMaterialGroup($value)
    {
        $this->refreshHistory();
    }
    public function updatedSupplier($value)
    {
        $this->refreshHistory();
    }
}
