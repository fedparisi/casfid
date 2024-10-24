<?php

namespace App\Services;

use App\Models\Pizza;
use CalculationService;
use ImageService;


/**
 * Class PizzaService
 * Handles the business logic for pizza operations.
 */
class PizzaService
{
  
    /**
     * Create a new pizza and calculate its total price.
     *
     * @param array $data
     * @return Pizza
     */
    public function createPizza(array $data): Pizza
    {
        // Use the CalculationService for calculate total from items
        $totalPrice = CalculationService::calculateTotalPrice($data['ingredients']);
        // Create the pizza
        $pizza = Pizza::create([
            'name' => $data['name'],
            'price' => $totalPrice, 
        ]);
        // Add ingredients to Pizza
        $pizza->ingredients()->attach($data['ingredients']);
        // Use the imageService to upload image
        if (isset($data['image'])) {
            $pizza->image = ImageService::uploadImage($data['image']);
            $pizza->save(); 
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
        // Use the CalculationService for calculate total from items
        $totalPrice = CalculationService::calculateTotalPrice($data['ingredients']);
        // Update the pizza
        $pizza->update([
            'name' => $data['name'],
            'price' => $totalPrice,
        ]);
        // Link ingredients to Pizza
        $pizza->ingredients()->sync($data['ingredients']);
        // Delete old image and upload new, trought imageService
        if (isset($data['image'])) {
            ImageService::deleteImage($data['image']);
            $pizza->image = ImageService::uploadImage($data['image']);
            $pizza->save();
        }

        return $pizza;
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
}
