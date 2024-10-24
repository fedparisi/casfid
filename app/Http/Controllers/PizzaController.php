<?php

namespace App\Http\Controllers;

use App\Contracts\ImageStorageInterface;
use App\Http\Requests\CreatePizzaRequest;
use App\Http\Requests\UpdatePizzaRequest;
use App\Models\Pizza;
use App\Models\Ingredient;
// Facade
use PizzaService;

/**
 * Class PizzaController
 * Handles the operations related to pizzas.
 */
class PizzaController extends Controller
{
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
        PizzaService::createPizza($request->validated());
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
        PizzaService::updatePizza($pizza, $request->validated());
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
        PizzaService::deletePizza($pizza);
        return redirect()->route('pizzas.index')->with('success', 'Pizza deleted successfully.');
    }
}
