<?php

namespace App\Observers;

use App\Models\Pizza;
use App\Services\PizzaService;

/**
 * Class PizzaObserver
 * Handles the events for the Pizza model.
 */
class PizzaObserver
{
    protected $pizzaService;

    public function __construct(PizzaService $pizzaService)
    {
        $this->pizzaService = $pizzaService; // Initialize PizzaService
    }

    /**
     * Handle the Pizza "created" event.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return void
     */
    public function created(Pizza $pizza)
    {
        // No image handling needed here, managed in PizzaService
    }

    /**
     * Handle the Pizza "updated" event.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return void
     */
    public function updated(Pizza $pizza)
    {
        // No image handling needed here, managed in PizzaService
    }

    /**
     * Handle the Pizza "deleted" event.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return void
     */
    public function deleted(Pizza $pizza)
    {
        // Delete image if exists
        $this->pizzaService->deletePizza($pizza);
    }
}
