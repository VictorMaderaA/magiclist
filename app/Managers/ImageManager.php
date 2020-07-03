<?php


namespace App\Managers;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageManager
{
    private $validImageTypes = [
        'image/bmp',
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    private $validGifTypes = [
        'image/gif',
    ];

    private $validVideoTypes = [
        'video/mp4',
        'video/avi',
        'video/mpeg',
        'video/quicktime'
    ];

    public function uploadImage(UploadedFile $file) : Media{
        $realName = $file->getClientOriginalName();
        $internalName = $file->hashName();
        $path = env('AWS_BUCKET_PATH') . '/userImages/';

        Storage::disk('s3')->put($path, $file);

        $media = new Media();
        $media->name = $realName;
        $media->path = $path . $internalName;
        $media->user_id = auth()->id();
        $media->mimeType = $file->getMimeType();
        $media->saveOrFail();
        $media->syncOriginal();
        return $media;
    }

    private function isImage(UploadedFile $file){
        return in_array($file->getMimeType(),$this->validImageTypes);
    }

    private function isGif(UploadedFile $file){
        return in_array($file->getMimeType(),$this->validGifTypes);
    }

    private function isVideo(UploadedFile $file){
        return in_array($file->getMimeType(),$this->validVideoTypes);
    }

    public function processImage(UploadedFile $file){

    }

    public function proccessGif(UploadedFile $file){
        $image = imagepng(imagecreatefromstring($file));
    }

}
