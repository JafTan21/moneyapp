<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierExport implements FromCollection
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        $data = $this->query->with([
            "user:id,email",
        ])->get();
        $info=[];

        foreach ($data as $row) {
            $info[] = [
                $row->id,
                $row->user->email,
                $row->contact,
                $row->mobile,
                $this->getProductsNames($row),
                $row->materials->sum('bill') - $row->payment,
                $row->payment,
                $row->balance,
            ];
        }

        return collect($info);
    }

    private function getProductsNames($row)
    {
        $names = "";
        foreach ($row->materials as $material) {
            $names = $names . $material->material_name . ", ";
        }

        return $names;
    }
}
