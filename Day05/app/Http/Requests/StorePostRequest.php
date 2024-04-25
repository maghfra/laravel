<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|min:3|unique:posts',
            'body' => 'required|min:10',
            'image' => 'required|mimes:png,jpg',
            'user_id' => 'exists:users,id'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is required.',
            'title.min' => 'Title must be at least 3 characters.',
            'title.unique' => 'Title must be unique.',
            'body.required' => 'Description is required.',
            'body.min' => 'Description must be at least 10 characters.',
            'user_id.exists' => 'Invalid user ID.'
            
        ];
    }

}
