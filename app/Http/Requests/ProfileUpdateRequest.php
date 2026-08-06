<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],

            'phone_number' => ['required', 'digits_between:10,15', 'regex:/^[0-9]+$/'],

            'birth_date' => ['required', 'date', 'before:today'],

            'gender' => ['required', 'in:male,female'],

            'street_address' => ['nullable', 'string', 'max:255'],

            'city' => ['nullable', 'string', 'max:100'],

            'state' => ['nullable', 'string', 'max:100'],

            'country' => ['nullable', 'string', 'size:2'],

            'locale' => ['nullable', 'string', 'size:5'],

            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
