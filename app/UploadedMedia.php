<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Http\UploadedFile;

class UploadedMedia extends Model implements HasMedia
{
    use HasMediaTrait;

    public static function add($file, $preservingOriginal = false)
    {
        if (is_string($file)) {
            $file = new File($file);
        }

        $uploadedMedia = static::firstOrCreate([]);
        $time = time();
        $name = $time . '_' . str_random(10);
        $extension = static::getFileExtension($file);
        $fileName = $time . '_' . str_random(10) . ($extension ? '.' . $extension : '');
        // $fileName = $time . '_' . str_random(10);

        $command = $uploadedMedia->addMedia($file)
            ->usingName($name)
            ->usingFileName($fileName);
        if ($preservingOriginal) {
            $command->preservingOriginal();
        }

        return $command->toMediaCollection();
    }

    public static function get($name)
    {
        return static::first()->media()->where('name', $name)->first();
    }

    protected static function getFileExtension($file)
    {
        if ($file instanceof UploadedFile) {
            return $file->getClientOriginalExtension();
        }

        return $file->getExtension();
    }
}
