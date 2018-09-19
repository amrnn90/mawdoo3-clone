<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $withCount = ['catPosts', 'subPosts'];

    public function scopePopular($query, $take = 7)
    {
        return $query
            ->whereNotNull('parent_id')
            // ->withCount('posts')
            ->orderByRaw('cat_posts_count + sub_posts_count desc');
    }

    public function posts($without = [])
    {
        $query = Post::whereNotIn('id', $without);

        if ($this->parent_id) {
            $query->where('subcategory_id', $this->id);
        } else {
            $subcategories = $this->subcategories->pluck('id');

            $query->where(function($query) use ($subcategories) {
                $query->where('category_id', $this->id)
                    ->orWhereIn('subcategory_id', $subcategories);
            });
        }
        return $query;
    }

    public function catPosts() {
        return $this->hasMany(Post::class);
    }

    public function subPosts() {
        return $this->hasMany(Post::class, 'subcategory_id');
    }

    // public function getPostsCountAttribute() {
    //     return $this->sub_posts_count + $this->cat_posts_count;
    // }

    public function getPostsAttribute() {
        return $this->catPosts->merge($this->subPosts);
    }

    public function getPostsCountAttribute() {
        return $this->cat_posts_count + $this->sub_posts_count;
    }

    public function parent() 
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function subcategories() 
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public static function getCategoriesWithSub() 
    {
        return static::whereNull('parent_id')->with('subcategories')->get();
    }
}
