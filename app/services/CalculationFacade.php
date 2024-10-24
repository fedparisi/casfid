<?php

namespace App\Services;

use Illuminate\Support\Facades\Facade;
use App\Services\CalculationService;

class CalculationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CalculationService::class;
    }
}