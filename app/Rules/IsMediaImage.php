<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File as FileInfo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\Models\Media;

class IsMediaImage implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $media = Media::where('name', $value)->first();
        
        if ($media) {
            // $storageRelPath = str_replace(Storage::disk($media->disk)->getAdapter()->getPathPrefix(), '', $media->getPath());

            $storageRelPath = implode('/', array_slice(explode('/', $media->getPath()), -2));

            $fileContent = Storage::disk($media->disk)->get($storageRelPath);

            $tempFileName = tempnam(sys_get_temp_dir(), 'MyFileName');

            \File::put($tempFileName, $fileContent);
            $file = new FileInfo($tempFileName);

            $validator = Validator::make(['imageFile' => $file], [
                'imageFile' => 'image'
            ]);

            $result = !$validator->fails();
            \File::delete($tempFileName);

            return $result;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Not an image media';
    }
}
