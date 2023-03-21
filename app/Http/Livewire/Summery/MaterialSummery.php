<?php

namespace App\Http\Livewire\Summery;

use App\Models\Material;
use App\Models\Project;
use Livewire\Component;

class MaterialSummery extends Component
{
    public $materialName;
    public $projectName;

    protected $listeners = [
        'set-date-values' => 'setDates'
    ];

    public int $i = 0;

    public $day = null, $month = "all", $year = null;
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
        if ($this->projectName) {
            $total = $total->whereHas('project', function ($query) {
                return $query->where('name', trim($this->projectName));
            });
        }



        if ($this->month != 'all') $total = $total->whereMonth('of', $this->month);
        if ($this->year != '') $total = $total->whereYear('of', $this->year);
        if ($this->day != '') $total = $total->whereDay('of', $this->day);

        $total = $total->sum('quantity');
        // $this->emit('update-material-history', $this->projectName, $this->materialName);
        $this->i++;
        return view('livewire.summery.material-summery', [
            'total_quantity' => $total,
            'projects' => Project::select('name')->distinct()->myData()->get(),
            'materials' => Material::select('material_name')->distinct()->myData()->get()
        ]);
    }

    public function refreshHistory()
    {
        $this->emit('update-material-history', $this->projectName, $this->materialName);
    }
    public function updatedProjectName($value)
    {
        $this->refreshHistory();
    }
    public function updatedMaterialName($value)
    {
        $this->refreshHistory();
    }
}