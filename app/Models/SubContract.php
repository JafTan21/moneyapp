<?php

namespace App\Models;

use App\Traits\HasMyData;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubContract extends Model
{
    use HasFactory;
    use Searchable;
    use HasMyData;

    public $fillable = [
        'of',
        'project_id',
        'construction_group',
        'leader',
        'payment',
        'user_id'
    ];

    public static $searchables = [
        'of',
        'project_id',
        'construction_group',
        'leader',
        'payment',
    ];

    public $timestamps = [
        'created_at',
        'updated_at',
        'of'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
