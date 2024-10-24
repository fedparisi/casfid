<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    // Muestra una lista de las pizzas
    public function index()
    {
        $pizzas = Pizza::with('ingredients')->get(); // Carga las pizzas con sus ingredientes
        return view('pizzas.index', compact('pizzas'));
    }

    // Muestra el formulario para crear una nueva pizza
    public function create()
    {
        $ingredients = Ingredient::all(); // Obtiene todos los ingredientes
        return view('pizzas.create', compact('ingredients'));
    }

    public function store(Request $request)
    {

        // Validar la entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Cambiado a 'nullable' y validado como imagen
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredients,id', // Verifica que cada ingrediente existe
        ]);
        
        $pizza = Pizza::create([
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $pizza->image = $imagePath;
            $pizza->save();
        }

        // Relacionar los ingredientes seleccionados
        $pizza->ingredients()->attach($request->ingredients);

        return redirect()->route('pizzas.index')->with('success', 'Pizza creada exitosamente.');
    }

    public function update(Request $request, Pizza $pizza)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Cambiado a 'nullable' y validado como imagen
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredients,id', // Verifica que cada ingrediente existe
        ]);

        // dd($pizza->image);

        // Actualizar la pizza
        $pizza->update($request->only('name', 'description'));

        // Actualizar los ingredientes
        $pizza->ingredients()->sync($request->ingredients);

        // Manejar la subida de imágenes si existe
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $pizza->image = $imagePath;
            $pizza->save();
        }

        return redirect()->route('pizzas.index')->with('success', 'Pizza actualizada exitosamente.');
    }

    // Muestra una pizza específica
    public function show(Pizza $pizza)
    {
        return view('pizzas.show', compact('pizza'));
    }

    // Muestra el formulario para editar una pizza
    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();
        return view('pizzas.edit', compact('pizza', 'ingredients'));
    }



    // Elimina una pizza de la base de datos
    public function destroy(Pizza $pizza)
    {
        // Borra la imagen si existe
        if ($pizza->image) {
            \Storage::delete('public/' . $pizza->image);
        }

        $pizza->delete(); // Elimina la pizza

        return redirect()->route('pizzas.index')->with('success', 'Pizza eliminada exitosamente.');
    }

    // Método adicional para obtener todas las pizzas con sus ingredientes
    public function getPizzasConIngredientes()
    {
        $pizzas = Pizza::with('ingredients')->get(); // Carga las pizzas con sus ingredientes
        return response()->json($pizzas); // Devuelve las pizzas como JSON
    }
}
