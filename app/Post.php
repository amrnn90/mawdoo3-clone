<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;
    use Viewable;

    protected $guarded = [];
    protected $slugField = 'title';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->user_id = $post->user_id ?? auth()->id();
            $post->category_id = $post->category_id ?? Category::first()->id;
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setImageAttribute($image)
    {
        if (is_string($image)) {
            $this->attributes['image'] = $image;
            return;
        }
        $path = $image->storeAs('public/posts', time() . '.' . $image->extension());
        $this->attributes['image'] = Storage::url($path);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory() 
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function visitorsAlsoRead($take = 12)
    {
        return static::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->inRandomOrder()
            ->take($take)
            ->get();
    }

    public function relatedPosts($take = 12)
    {
        // should be with search maybe or tags
        return $this->visitorsAlsoRead($take);
    }
}
