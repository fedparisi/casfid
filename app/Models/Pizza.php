<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'image', 'price'];

    /**
     * Get the ingredients for the pizza.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_pizza');
    }

    /**
     * Calculate the total price of the pizza.
     *
     * @return float
     */
    public function getPriceAttribute()
    {
        $totalIngredientPrice = $this->ingredients->sum('price');
        return $totalIngredientPrice + ($totalIngredientPrice * 0.50);
    }
}
