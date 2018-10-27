<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;

class Post extends Model implements HasMedia
{
    use Sluggable;
    use Viewable;
    use HasMediaTrait;

    protected $guarded = [];
    protected $slugField = 'title';
    protected $tempMediaName;

    public static function boot()
    {

        parent::boot();

        static::creating(function ($post) {
            $post->user_id = $post->user_id ?? auth()->id();
            $post->category_id = $post->category_id ?? Category::first()->id;
        });

        static::saved(function ($post) {
            if ($post->tempMediaName) {
                $media = Media::where('name', $post->tempMediaName)->first();

                if ($post->getMedia('image')->where('id', $media->id)->first()) {
                    return;
                }
        
                $media->move($post, 'image');

                $post->tempMediaName = null;
            } else {
                $post->clearMediaCollection('image');
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setContentAttribute($content) {
        $this->attributes['content'] = app()->make(PostContentPrepare::class)->prepare($content);
    }

    public function setImageAttribute($mediaName)
    {
        $this->tempMediaName = $mediaName;
    }

    public function getImageAttribute()
    {
        if ($media = $this->getFirstMedia('image')) {
            return $media->getUrl();
        }
    }

    public function getThumbAttribute()
    {
        if ($media = $this->getFirstMedia('image')) {
            return $media->getUrl('thumb');
        }
    }

    public function getImageNameAttribute() {
        if ($media = $this->getFirstMedia('image')) {
            return $media->name;
        }
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

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 215, 150)
            // ->width(215)
            // ->height(150)
            ->nonQueued();
    }
}
