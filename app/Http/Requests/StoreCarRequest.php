<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_price' => 'required|numeric|between:100000,9999999',
            'rental_price' => 'required|numeric|between:100,20000',
            'name' => 'required|min:2|max:255',
            'brand' => 'required|min:2|max:255',
            'color' => [
                'required',
                Rule::in(['white', 'black', 'silver', 'red', 'green', 'blue'])
            ],
            'transmission' => [
                'required',
                Rule::in(['manual', 'automatic'])
            ],
            'fuel' => [
                'required',
                Rule::in(['petrol', 'diesel', 'electrical'])
            ],
            'power' => 'required|integer|between:25,296'
        ];
    }
}
