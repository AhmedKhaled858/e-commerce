<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
        $category_id=$this->route('id');
        return [
            //
            'category_name'=>[
            
                'required',
                'string',
                'max:255',
                'filter:admin,administrator,superuser,root,system,manager,moderator,owner,webmaster,developer,editor,contributor,subscriber,user,guest,test,demo,temp,temporary,invalid,null,n/a,none,unknown',
                Rule::unique('categories','name')->ignore($category_id),
            ],
            'parent_id'=>'nullable|exists:categories,id',
            'description'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'=>'in:active,archived',
            
            
        ];
    }
    public function messages(): array
    {
        return [
            'category_name.required' => 'Category name is required',
            'category_name.string' => 'Category name must be a string',
            'category_name.max' => 'Category name must not exceed 255 characters',
            'parent_id.exists' => 'Selected parent category does not exist',
            'description.string' => 'Description must be a string',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg',
            'image.max' => 'The image size must not exceed 2048 kilobytes',
            'status.in' => 'Status must be either active or archived',
        ];
    }
}
