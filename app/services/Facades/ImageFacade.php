<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\ImageService;

class ImageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ImageService::class;
    }
}