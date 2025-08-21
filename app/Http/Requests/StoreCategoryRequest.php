<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'image' => 'mimes:png,jpg,jpeg',
        ];
    }


    public function messages(): array
    {
        return [
            'name_en.required' => 'english name is required.',
            'name_ar.required' => 'arabic name is required.',
            'image.mimes' => 'The image must be a file of type: png, jpg , jpeg.',
        ];
    }
}

