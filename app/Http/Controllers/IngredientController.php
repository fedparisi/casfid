<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Http\Requests\CreateIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use Illuminate\Http\Request;

/**
 * Class IngredientController
 * Handles operations related to ingredients.
 */
class IngredientController extends Controller
{
    /**
     * Display a listing of ingredients.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $ingredients = Ingredient::all(); 
        return view('ingredients.index', compact('ingredients')); 
    }

    /**
     * Show the form for creating a new ingredient.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('ingredients.create'); 
    }

    /**
     * Store a newly created ingredient in the database.
     *
     * @param  \App\Http\Requests\CreateIngredientRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateIngredientRequest $request)
    {
        Ingredient::create($request->all());

        return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully.'); 
    }

    /**
     * Show the form for editing the specified ingredient.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\View\View
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient')); 
    }

    /**
     * Remove the specified ingredient from the database.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete(); 

        return redirect()->route('ingredients.index')->with('success', 'Ingredient deleted successfully.'); 
    }
}
