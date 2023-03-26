<?php

namespace App\Models;

use App\Traits\HasMyData;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    use HasFactory;
    use Searchable;
    use HasMyData;

    public $fillable = [
        'of',
        'project_id',
        'daily_worker',
        'daily_foreman',
        'construction_group',
        'group_leader',
        'daily_labor_payment',
        'user_id',
    ];

    public static $searchables = [
        'of',
        'project_id',
        'daily_worker',
        'daily_foreman',
        'construction_group',
        'group_leader',
        'daily_labor_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return  $this->belongsTo(Project::class);
    }
}
