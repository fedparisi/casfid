<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

/**
 * Class ImageService
 * Handles image uploads and management.
 */
class ImageService
{
    /**
     * Upload an image and return the path.
     *
     * @param  \Illuminate\Http\UploadedFile  $image
     * @return string|null
     */
    public function uploadImage($image)
    {
        if ($image) {
            return $image->store('images', 'public'); 
        }
        return null; 
    }

    /**
     * Delete an image from storage.
     *
     * @param  string  $imagePath
     * @return void
     */
    public function deleteImage($imagePath)
    {
        if ($imagePath) {
            Storage::delete('public/' . $imagePath); 
        }
    }
}
