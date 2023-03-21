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
        // 'company',
        'mobile',
        // 'email',
        // 'product',
        // 'material_id',
        'user_id',

        'bill',
        'payment',
        'balance'
    ];

    public static $searchables = [
        'contact',
        // 'company',
        'mobile',
        // 'email',
        // 'product',

        'bill',
        'payment',
        'balance',
        // 'material_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}