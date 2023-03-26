<?php

namespace App\Models;

use App\Traits\HasMyData;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use Searchable;
    use HasFactory;
    use HasMyData;

    public $fillable = [
        'in', 'out', 'of', 'description', 'user_id', 'project_id'
    ];

    public static $searchables = [
        'in', 'out', 'of', 'description', 'project_id'
    ];

    public $timestamps = [
        'created_at',
        'updated_at',
        'of'
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
