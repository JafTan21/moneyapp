<?php

namespace App\Http\Livewire\Summery;

use App\Exports\SubContractExport;
use App\Models\ConstructionGroup;
use App\Models\Project;
use App\Models\SubContract;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SubContractorSummery extends Component
{
    public $constructionGroup;
    public $projectName;
    protected $listeners = [
        'set-date-values' => 'setDates'
    ];


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
        return view('livewire.summery.sub-contractor-summery', [
            'total_amount' => $this->getQuery()->sum('payment'),
            'groups' => ConstructionGroup::select('name')
                ->distinct()
                ->get(),
            'projects' => Project::select('name')->distinct()->myData()->get()
        ]);
    }

    private function getQuery()
    {
        $query = SubContract::query()->myData();

        if ($this->constructionGroup) {
            $query = $query->where('construction_group', trim($this->constructionGroup));
        }

        if ($this->projectName) {
            $query = $query->whereHas('project', function ($query) {
                return $query->where('name', trim($this->projectName));
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
            new SubContractExport(
                $this->getQuery()
            ),
            'sub-contract.xlsx'
        );
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
