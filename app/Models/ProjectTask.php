<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    public $fillable = [
        // 'of',
        'name',
        'project_id',
        'user_id',

        'start_date',
        'end_date',
        'progress_rate',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public const Statuses = [
        'Ongoing',
        'Not started',
        'Completed',
    ];
}