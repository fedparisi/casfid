<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'price'];

    /**
     * Get the pizzas that have this ingredient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class)->withTimestamps();
    }
}
