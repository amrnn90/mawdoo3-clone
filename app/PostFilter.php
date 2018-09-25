<?php

namespace App;

class PostFilter {
    static protected $fields = ['latest'];

    static public function filter($builder = null) 
    {
        $builder = $builder ?? Post::query();

        foreach (static::$fields as $field) {
            if (request()->has($field)) {
                $value = request()->get($field);
                static::$field($builder, $value);
            }
        }

        return $builder;
    }

    static public function latest($builder, $value) {
        if ($value) {
            $builder->latest();
        }
    }

}  