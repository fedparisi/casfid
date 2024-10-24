<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\PizzaService;

class PizzaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PizzaService::class;
    }
}