<?php

namespace App\Models;

use App\Traits\HasMyData;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractedForm extends Model
{
    use HasFactory;
    use Searchable;
    use HasMyData;

    public $fillable = [
        'description',
        'unit_of_works',
        'quantity_of_work',
        'unit_rate',
        'completed_quantity',
        'total_amount',
        'project_id',

        'user_id'
    ];

    public static $searchables = [
        'description',
        'unit_of_works',
        'quantity_of_work',
        'unit_rate',
        'completed_quantity',
        'total_amount',
        'project_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
