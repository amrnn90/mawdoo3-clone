<?php

namespace App;

class PostFilter {
    static protected $fields = ['latest', 'mostViewed', 'search'];

    static public function filter($params, $builder = null) 
    {
        $builder = $builder ?? Post::query();

        foreach (static::$fields as $field) {
            if (array_key_exists($field, $params)) {
                $value = $params[$field];
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

    static public function mostViewed($builder, $value) {
        if ($value) {
            $builder->mostViewed();
        }
    }

}  