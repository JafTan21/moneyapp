<?php

namespace App\Http\Livewire\Summery;

use App\Models\ConstructionGroup;
use App\Models\Project;
use App\Models\SubContract;
use Livewire\Component;

class SubContractorSummery extends Component
{

    public $constructionGroup, $projectName;
    protected $listeners = [
        'set-date-values' => 'setDates'
    ];


    public $day = null, $month = "all", $year = null;
    public function setDates($day, $month, $year)
    {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }


    public function render()
    {
        $total = SubContract::query()->myData();

        if ($this->constructionGroup) {
            $total = $total->where('construction_group', trim($this->constructionGroup));
        }

        if ($this->projectName) {
            $total = $total->whereHas('project', function ($query) {
                return $query->where('name', trim($this->projectName));
            });
        }


        if ($this->month != 'all') $total = $total->whereMonth('of', $this->month);
        if ($this->year != '') $total = $total->whereYear('of', $this->year);
        if ($this->day != '') $total = $total->whereDay('of', $this->day);



        return view('livewire.summery.sub-contractor-summery', [
            'total_amount' => $total->sum('payment'),
            'groups' => ConstructionGroup::select('name')
                ->distinct()
                ->get(),
            'projects' => Project::select('name')->distinct()->myData()->get()
        ]);
    }
    private function refreshHistory()
    {
        $this->emit('update-sub-contractors-history', $this->projectName, $this->constructionGroup);
    }
    public function updatedProjectName()
    {
        $this->refreshHistory();
    }
    public function updatedConstructionGroup()
    {
        $this->refreshHistory();
    }
}