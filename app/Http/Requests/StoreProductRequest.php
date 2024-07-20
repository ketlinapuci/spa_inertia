<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:10'],
            'brand' => ['required', 'string', 'min:5'],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'Category'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'price' => $this->price * 100
        ]);
    }
}
