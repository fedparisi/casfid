<?php

namespace App\Services;

use App\Models\Ingredient;

class CalculationService
{

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


