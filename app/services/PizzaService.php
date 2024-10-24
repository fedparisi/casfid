<?php

namespace App\Services;

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
     * Create a new pizza and handle image upload.
     *
     * @param  array  $data
     * @return \App\Models\Pizza
     */
    public function createPizza(array $data)
    {
        // Create the pizza
        $pizza = Pizza::create([
            'name' => $data['name'],
        ]);

        // Handle image upload using imageService
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
     * @return void
     */
    public function updatePizza(Pizza $pizza, array $data)
    {
        // Update pizza details
        $pizza->update($data);

        // Handle image upload if an image is provided
        if (isset($data['image'])) {
            // Delete old image from storage
            $this->imageService->deleteImage($pizza->image);
            // Upload new image
            $pizza->image = $this->imageService->uploadImage($data['image']);
            $pizza->save(); // Save the pizza with the updated image path
        }

        // Update ingredients
        if (isset($data['ingredients'])) {
            $pizza->ingredients()->sync($data['ingredients']);
        }
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
