<?php

namespace App\Services;

use App\Models\Ingredient;
use App\Models\Pizza;
use CalculationService;

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
        // Use the CalculationService for calculate total from items
        $totalPrice = CalculationService::calculateTotalPrice($data['ingredients']);

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
        $totalPrice = CalculationService::calculateTotalPrice($data['ingredients'] ?? []);

        $pizza->update([
            'name' => $data['name'],
            'price' => $totalPrice,
        ]);

        if (isset($data['image'])) {
            if ($pizza->image) {
                $this->imageService->deleteImage($pizza->image);
            }
            $pizza->image = $this->imageService->uploadImage($data['image']);
            $pizza->save();
        }

        if (isset($data['ingredients'])) {
            $pizza->ingredients()->sync($data['ingredients']);
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
