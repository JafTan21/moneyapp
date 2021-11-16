<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use Searchable;

    public $fillable = [
        'name', 'start', 'end', 'sponsor', 'value', 'description', 'status', 'user_id'
    ];

    public static $searchables = [
        'name', 'start', 'end', 'sponsor', 'value', 'description', 'status'
    ];

    public $timestamps = [
        'created_at',
        'updated_at',
        'start',
        'end'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}