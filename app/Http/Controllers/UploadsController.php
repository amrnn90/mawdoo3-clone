<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\UploadedMedia;
use Spatie\MediaLibrary\Models\Media;

class UploadsController extends Controller
{
    public function store(Request $request)
    {
        $validationRules = collect(array_keys($request->allFiles()))
            ->mapWithKeys(function ($key) {
                return [$key => 'image'];
            })->all();

        $validator = \Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $allFiles = $request->allFiles();

        if ($file = reset($allFiles)) {
            $media = UploadedMedia::add($file);
            return $media->name;   
        }

        return null;
    }

    public function load(Request $request)
    {
        return response()->file(Media::where('name', $request->load)->first()->getPath());
        // return response()->file(Storage::path($request->load));
    }

    public function revert(Request $request)
    {
        $media = Media::where('name', $request->getContent())->first();
        if ($media) {
            $media->delete();
        }
        return '';
    }
}
