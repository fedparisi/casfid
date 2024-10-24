<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Ingredient;
use App\Http\Requests\CreatePizzaRequest;
use App\Http\Requests\UpdatePizzaRequest;
use Illuminate\Http\Request;

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
        // Create pizza
        $pizza = Pizza::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); 
            $pizza->image = $imagePath; 
            $pizza->save();
        }

        // Attach selected ingredients
        $pizza->ingredients()->attach($request->ingredients);

        return redirect()->route('pizzas.index')->with('success', 'Pizza created successfully.'); // Redirect with success message
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
        // Update pizza details
        $pizza->update($request->only('name', 'price'));
        if ($request->hasFile('image')) {
            // Delete the old image from storage if it exists
            if ($pizza->image) {
                \Storage::delete('public/' . $pizza->image); 
            }
            $imagePath = $request->file('image')->store('images', 'public'); // Store new image
            $pizza->image = $imagePath; // Update image path
            $pizza->save(); // Save changes
        }

        // Update ingredients
        $pizza->ingredients()->sync($request->ingredients);

        return redirect()->route('pizzas.index')->with('success', 'Pizza updated successfully.'); // Redirect with success message
    }

    /**
     * Remove the specified pizza from the database.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pizza $pizza)
    {
        // Delete image if exists
        if ($pizza->image) {
            \Storage::delete('public/' . $pizza->image); 
        }

        $pizza->delete();

        return redirect()->route('pizzas.index')->with('success', 'Pizza deleted successfully.'); 
    }

}
