<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGalleryStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'at' => ['required', 'date'],
            'file' => ['image', 'max:1024', 'required'],
            'name' => ['nullable', 'max:255', 'string'],
            'description' => ['nullable', 'string'],
            'type' => ['nullable', 'max:255', 'string'],
            'metadata' => ['nullable', 'json'],
            'thumbnail' => ['nullable', 'string'],
        ];
    }
}
