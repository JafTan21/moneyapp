<?php

namespace App\Traits;

trait Searchable
{
    public static function search($search_val = null)
    {
        $fields = (self::$searchables);
        $query = self::where(function ($q) use ($fields, $search_val) {
            foreach ($fields as $field) {
                $q = $q->orWhere($field, 'like', '%' . $search_val . '%');
            }
        });
        // echo ($query->toSql());
        return $query;
    }
}