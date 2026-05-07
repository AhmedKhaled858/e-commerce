<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_quantity' => 'required|integer|min:0',
            'product_price' => 'required|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_category' => 'required|exists:categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'product_title.required' => 'Product title is required',
            'product_price.min' => 'Price must be positive',
            'product_quantity.min' => 'Quantity must be positive',
            'product_image.required' => 'Product image is required',
            'product_image.mimes' => 'The image must be a file of type: jpg, jpeg, png, webp',
            'product_image.image' => 'The file must be an image',
        ];
    }
}
