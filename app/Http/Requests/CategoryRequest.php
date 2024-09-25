<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories,name|string|min:2|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio',
            'name.min' => 'Il nome deve contenere almeno :min caratteri',
            'name.max' => 'Il nome può avere massimo :max caratteri',
            'name.unique' => 'Il campo è gia presente nel db',


        ];
    }
}
