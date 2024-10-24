<?php

namespace App\Contracts;

interface ImageStorageInterface
{
    /**
     * Upload an image and return the path.
     *
     * @param  \Illuminate\Http\UploadedFile  $image
     * @return string|null
     */
    public function uploadImage($image);

    /**
     * Delete an image from storage.
     *
     * @param  string  $imagePath
     * @return void
     */
    public function deleteImage($imagePath);
}
