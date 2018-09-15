<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function scopePopular($query, $take = 7)
    {
        return $query
            ->withCount('posts')
            ->orderBy('posts_count', 'desc');
    }

    public function posts($without = [])
    {
        return $this->hasMany(Post::class)
            ->whereNotIn('id', $without);
    }
}
