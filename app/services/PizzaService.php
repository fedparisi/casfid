<?php

namespace App\Services;

use App\Models\Ingredient;
use App\Models\Pizza;

/**
 * Class PizzaService
 * Handles the business logic for pizza operations.
 */
class PizzaService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Create a new pizza and calculate its total price.
     *
     * @param array $data
     * @return Pizza
     */
    public function createPizza(array $data)
    {
        // Calculate the total price
        $totalPrice = $this->calculateTotalPrice($data['ingredients'] ?? []);

        // Create the pizza
        $pizza = Pizza::create([
            'name' => $data['name'],
            'price' => $totalPrice, // Store the calculated total price
        ]);

        // Use the imageService to upload image
        if (isset($data['image'])) {
            $pizza->image = $this->imageService->uploadImage($data['image']);
            $pizza->save(); // Save the pizza with the new image path
        }

        // Attach selected ingredients
        if (isset($data['ingredients'])) {
            $pizza->ingredients()->attach($data['ingredients']);
        }

        return $pizza; // Return the created pizza
    }


    /**
     * Update an existing pizza and handle image upload.
     *
     * @param  \App\Models\Pizza  $pizza
     * @param  array  $data
     * @return \App\Models\Pizza
     */
    public function updatePizza(Pizza $pizza, array $data): Pizza
    {
        // Calculate the total price based on the ingredients
        $totalPrice = $this->calculateTotalPrice($data['ingredients'] ?? []);

        $pizza->update([
            'name' => $data['name'],
            'price' => $totalPrice, // Store the calculated total price
        ]);

        if (isset($data['image'])) {
            // Use imageService to delete old image from storage if it exists
            if ($pizza->image) {
                $this->imageService->deleteImage($pizza->image);
            }
            // Upload new image and update image path
            $pizza->image = $this->imageService->uploadImage($data['image']);
            $pizza->save(); // Save the pizza with the updated image path
        }

        // Update ingredients
        if (isset($data['ingredients'])) {
            $pizza->ingredients()->sync($data['ingredients']);
        }

        return $pizza; // Return the updated pizza
    }


    /**
     * Delete a pizza and its image.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return void
     */
    public function deletePizza(Pizza $pizza)
    {
        // Delete image if exists
        $this->imageService->deleteImage($pizza->image);
        $pizza->delete(); // Delete the pizza
    }


    /**
     * Calculate the total price of a pizza based on its ingredients.
     *
     * @param array $ingredientIds
     * @return float
     */
    public function calculateTotalPrice(array $ingredientIds): float
    {
        $total = 0;

        if (!empty($ingredientIds)) {
            // Sum the prices of the ingredients
            $total = Ingredient::whereIn('id', $ingredientIds)->sum('price');
        }

        // Add 50% of the total to the pizza price
        return round($total * 1.5, 2); // Return total price rounded to 2 decimal places
    }
}
