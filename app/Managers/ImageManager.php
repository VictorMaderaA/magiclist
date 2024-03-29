<?php


namespace App\Managers;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageManager
{

    public function uploadImage(UploadedFile $file) : Media{

        $realName = $file->getClientOriginalName();
        $internalName = $file->hashName();
        $path = 'magicList/userImages/';

        Storage::disk('s3')->put($path, $file);

        $media = new Media();
        $media->name = $realName;
        $media->path = $path = 'magicList/userImages/' . $internalName;
        $media->user_id = auth()->id();
        $media->mimeType = $file->getMimeType();
        $media->saveOrFail();
        $media->syncOriginal();
        return $media;
    }

}
