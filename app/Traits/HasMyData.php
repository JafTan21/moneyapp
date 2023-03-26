<?php

namespace App\Traits;

trait HasMyData
{
    public function scopeMyData($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
