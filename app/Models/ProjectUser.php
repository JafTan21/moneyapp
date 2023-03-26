<?php

namespace App\Models;

use App\Traits\HasMyData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;
    use HasMyData;

    public $fillable = [
        'project_id', 'user_id'
    ];
}
