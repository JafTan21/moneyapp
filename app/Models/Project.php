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
        'name',
        'start',
        'end',
        'sponsor',
        'value',
        'description',
        'status',
        'user_id',
        'progress'
    ];

    public static $searchables = [
        'name', 'start', 'end', 'sponsor', 'value', 'description', 'status', 'progress'
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

    public function getViewersAttribute()
    {
        $ids = ProjectUser::where('project_id', $this->id)->select('user_id')->get();

        return User::whereIn('id', $ids)->get();
    }

    public function labors()
    {
        return $this->hasMany(Labor::class);
    }

    public function todays_labors()
    {
        return $this->hasMany(Labor::class)->whereDay('of', now()->day);
    }

    public function monies()
    {
        return $this->hasMany(Money::class);
    }
}