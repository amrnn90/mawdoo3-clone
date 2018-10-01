<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class UploadedMedia extends Model implements HasMedia
{
    use HasMediaTrait;

    public static function add($file) 
    {
        $uploadedMedia = static::firstOrCreate([]);
        $time = time();
        $name = $time . '_' . str_random(10);
        $extension = $file->getClientOriginalExtension();
        $fileName = $time . '_' . str_random(10) . ($extension ? '.' . $extension : '');

        return $uploadedMedia->addMedia($file)
            ->usingName($name)
            ->usingFileName($fileName)
            ->toMediaCollection();
    }

    public static function get($name) 
    {
        return static::first()->media()->where('name', $name)->first();
    }
}
