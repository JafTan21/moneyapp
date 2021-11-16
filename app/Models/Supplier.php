<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory, Searchable;

    public $fillable = [
        'contact',
        'company',
        'mobile',
        'email',
        'product',
        'user_id'
    ];

    public static $searchables = [
        'contact',
        'company',
        'mobile',
        'email',
        'product',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}