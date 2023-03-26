<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubContractExport implements FromCollection
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
                $row->of,
                $row->project->name,
                $row->construction_group,
                $row->leader,
                $row->payment,
            ];
        }

        return collect($info);
    }
}
