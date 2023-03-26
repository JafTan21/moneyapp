<?php

namespace App\Models;

use App\Traits\HasMyData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionGroup extends Model
{
    use HasFactory;
    use HasMyData;

    public $fillable = [
        'name', 'description'
    ];

    // static $values = [
    //     'CIVIL',
    //     'STEEL',
    //     'ELECTRIC',
    //     'SANITARY',
    //     'PAINTING',
    // ];
}
