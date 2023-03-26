<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContractedExport implements FromCollection
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        $data = $this->query->with([
            "project:id,name",
            "user:id,email"
        ])->get();
        $info=[];

        foreach ($data as $row) {
            $info[] = [
                $row->id,
                $row->user->email,
                $row->description,
                $row->unit_of_works,
                $row->quantity_of_work,
                $row->unit_rate,
                $row->total_amount,
                $row->project->name,
            ];
        }

        return collect($info);
    }
}
