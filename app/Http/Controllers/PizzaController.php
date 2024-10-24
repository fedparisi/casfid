<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePizzaRequest;
use App\Http\Requests\UpdatePizzaRequest;
use App\Models\Pizza;
use App\Models\Ingredient;

use App\Services\PizzaService;

/**
 * Class PizzaController
 * Handles the operations related to pizzas.
 */
class PizzaController extends Controller
{
    protected $pizzaService;

    public function __construct(PizzaService $pizzaService)
    {
        $this->pizzaService = $pizzaService; // Initialize PizzaService
    }

    /**
     * Display a listing of pizzas with their ingredients.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pizzas = Pizza::with('ingredients')->get(); 
        return view('pizzas.index', compact('pizzas'));
    }

    /**
     * Show the form for creating a new pizza.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $ingredients = Ingredient::all(); 
        return view('pizzas.create', compact('ingredients'));
    }

    /**
     * Store a newly created pizza in the database.
     *
     * @param  \App\Http\Requests\CreatePizzaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePizzaRequest $request)
    {
        // Use PizzaService to create a new pizza
        $this->pizzaService->createPizza($request->validated());
        return redirect()->route('pizzas.index')->with('success', 'Pizza created successfully.');
    }

    /**
     * Show the form for editing the specified pizza.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\View\View
     */
    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all(); 
        return view('pizzas.edit', compact('pizza', 'ingredients'));
    }

    /**
     * Update the specified pizza in the database.
     *
     * @param  \App\Http\Requests\UpdatePizzaRequest  $request
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePizzaRequest $request, Pizza $pizza)
    {
        // Use PizzaService to update the pizza
        $this->pizzaService->updatePizza($pizza, $request->validated());
        return redirect()->route('pizzas.index')->with('success', 'Pizza updated successfully.');
    }

    /**
     * Remove the specified pizza from the database.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pizza $pizza)
    {
        // Use PizzaService to delete the pizza
        $this->pizzaService->deletePizza($pizza);
        return redirect()->route('pizzas.index')->with('success', 'Pizza deleted successfully.');
    }
}
