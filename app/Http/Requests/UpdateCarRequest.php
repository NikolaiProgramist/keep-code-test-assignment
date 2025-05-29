<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarRequest extends FormRequest
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
            'name' => 'min:2|max:255',
            'brand' => 'min:2|max:255',
            'color' => [
                Rule::in(['white', 'black', 'silver', 'red', 'green', 'blue'])
            ],
            'transmission' => [
                Rule::in(['manual', 'automatic'])
            ],
            'fuel' => [
                Rule::in(['petrol', 'diesel', 'electrical'])
            ],
            'power' => 'integer|between:25,296'
        ];
    }
}
