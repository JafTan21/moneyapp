<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use Searchable;
    use HasFactory;

    public $fillable = [
        'in', 'out', 'of', 'description', 'user_id'
    ];

    public static $searchables = [
        'in', 'out', 'of', 'description'
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
}