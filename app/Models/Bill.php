<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory, Searchable;

    public $fillable = [
        'number',
        'project_id',
        'amount',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public static $searchables = [
        'number',
        'project_id',
        'amount',
        'created_at',
        'updated_at'
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