<?php

namespace App\Exports;

use App\Models\Material;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;

class MaterialExport implements FromCollection
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function headings(): array
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }

    public function collection()
    {
        $data = $this->query->with([
            "supplier:id,contact",
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
                $row->supplier->contact,
                $row->material_name,
                $row->material_group,
                $row->quantity,
                $row->rate,
                $row->transporation_cost,
                $row->labor_cost,
                $row->unit,
            ];
        }

        return collect($info);
    }
}
