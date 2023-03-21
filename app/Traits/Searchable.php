<?php

namespace App\Traits;

trait Searchable
{
    public static function search($search_val = null, $orderBy = 'id')
    {
        $search_val = trim($search_val);
        $fields = (self::$searchables);
        $query = self::where(function ($q) use ($fields, $search_val) {
            $q = Searchable::inner_search($search_val, $fields, $q);
        })->latest($orderBy);
        // print_r($query->toSql());
        return $query;
    }

    public static function inner_search($search_val = null, $fields, $q, $is_first = false)
    {
        if (!$search_val) return $q;
        foreach ($fields as $field) {

            $model = null;
            if (str_ends_with($field, '_id')) {
                $model = (substr($field, 0, strlen($field) - 3)); //ucfirst
                // $model = ('\\App\\Models\\' . $model);
            }

            if ($model) {
                $q = $q->orWhereHas($model, function ($query) use ($model, $search_val) {
                    $model = ucfirst('\\App\\Models\\' . $model);
                    return Searchable::inner_search($search_val, $model::$searchables, $query, true);
                });
            } else {
                if ($is_first) {
                    $q = $q->Where($field, 'like', '%' . $search_val . '%');
                } else {
                    $q = $q->orWhere($field, 'like', '%' . $search_val . '%');
                }
            }

            $is_first = false;
        }

        return $q;
    }
}