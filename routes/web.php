<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\IngredientController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para el CRUD de Pizzas
    Route::resource('pizzas', PizzaController::class);

    // Rutas para el CRUD de Ingredientes
    Route::resource('ingredients', IngredientController::class); 

    // Ruta para obtener todas las pizzas con sus ingredientes
    Route::get('/pizzas/con-ingredientes', [PizzaController::class, 'getPizzasConIngredientes']);
});



