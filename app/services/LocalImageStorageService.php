<?php

namespace App\Services;

use App\Contracts\ImageStorageInterface;
use Illuminate\Support\Facades\Storage;

/**
 * Class LocalImageStorageService
 * Implements image storage using Laravel's local storage system.
 */
class LocalImageStorageService implements ImageStorageInterface
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
            return $image->store('images', 'public'); // Store in 'storage/app/public/images'
        }
        return null;
    }

    /**
     * Delete an image from local storage.
     *
     * @param  string  $imagePath
     * @return void
     */
    public function deleteImage($imagePath)
    {
        if ($imagePath) {
            Storage::delete('public/' . $imagePath); // Delete from 'storage/app/public/images'
        }
    }
}
