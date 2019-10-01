<?php 

namespace App;

trait Sluggable
{
    public static function bootSluggable()
    {
        static::creating(function($model) {
            $slug_field = $model->slugField ?? 'title';
            $model->slug = static::generateSlug($model->{$slug_field});
        });

    }

    public static function generateSlug($title)
    {
        // https://stackoverflow.com/questions/30582600/laravel-generate-slug-before-save

        // produce a slug based on the activity title
        $slug = str_slug($title);

        // check to see if any other slugs exist that are the same & count them
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        // if other slugs exist that are the same, append the count to the slug
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
