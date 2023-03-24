<?php

namespace App\Http\Livewire\Summery;

use App\Exports\MaterialExport;
use App\Models\Material;
use App\Models\Project;
use App\Models\Supplier;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

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
        $query = $this->getQuery();

        $total = $query->sum('quantity');

        $this->i++;
        return view('livewire.summery.material-summery', [
            'total_quantity' => $total,
            'projects' => Project::select('name')->distinct()->myData()->get(),
            'material_names' => Material::select('material_name')->distinct()->myData()->get(),
            'material_groups' => Material::select('material_group')->distinct()->myData()->get(),
            'suppliers' => Supplier::select('contact')->distinct()->myData()->get(),
        ]);
    }

    private function getQuery()
    {
        $query = Material::query()->myData();

        if ($this->materialName) {
            $query = $query->where('material_name', trim($this->materialName));
        }
        if ($this->materialGroup) {
            $query = $query->where('material_group', trim($this->materialGroup));
        }
        if ($this->supplier) {
            $query = $query->whereHas('supplier', function ($q) {
                return $q->where('contact', trim($this->supplier));
            });
        }
        if ($this->projectName) {
            $query = $query->whereHas('project', function ($q) {
                return $q->where('name', trim($this->projectName));
            });
        }



        if ($this->month != 'all') {
            $query = $query->whereMonth('of', $this->month);
        }
        if ($this->year != '') {
            $query = $query->whereYear('of', $this->year);
        }
        if ($this->day != '') {
            $query = $query->whereDay('of', $this->day);
        }

        return $query;
    }

    public function export()
    {
        return Excel::download(
            new MaterialExport(
                $this->getQuery()
            ),
            'materials.xlsx'
        );
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
