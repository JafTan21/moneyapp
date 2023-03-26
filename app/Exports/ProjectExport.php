<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProjectExport implements FromCollection
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        $data = $this->query->with([
            "user:id,email"
        ])->get();
        $info=[];

        foreach ($data as $row) {
            $info[] = [
                $row->id,
                $row->user->email,
                $row->name,
                $row->start,
                $row->end,
                $row->sponsor,
                $row->value,
                $row->progress,
                $row->description,
                $row->status,
                $row->status,
            ];
        }

        return collect($info);
    }
}
