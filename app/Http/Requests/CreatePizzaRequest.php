<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validation request for creating a pizza.
 */
class CreatePizzaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', 
            'ingredients' => 'required|array', 
            'ingredients.*' => 'exists:ingredients,id', 
        ];
    }
}
