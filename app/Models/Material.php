<?php

namespace App\Models;

use App\Traits\HasMyData;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    use Searchable;
    use HasMyData;

    public $fillable = [
        'of',
        'project_id',
        'material_name',
        'material_group',
        'quantity',
        'supplier_id',
        // 'transporation_cost',
        // 'labor_cost',
        'user_id',
        'unit',
        'rate',
    ];

    public static $searchables = [
        'project_id',
        'material_name',
        'material_group',
        'quantity',
        'supplier_id',
        // 'transporation_cost',
        // 'labor_cost',
        'unit',
        'rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
