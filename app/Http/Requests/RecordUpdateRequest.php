<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecordUpdateRequest extends FormRequest
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
            'user_id' => ['nullable', 'uuid', 'exists:users,id'],
            'string' => ['required', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'integer' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'decimal' => ['nullable', 'numeric'],
            'n_p_w_p' => ['nullable'],
            'datetime' => ['nullable', 'date'],
            'date' => ['nullable', 'date'],
            'time' => ['nullable', 'date_format:H:i'],
            'i_p_address' => ['nullable', 'ip'],
            'boolean' => ['nullable', 'boolean'],
            'enumerate' => ['nullable', 'in:enabled,disabled'],
            'text' => ['nullable', 'string'],
            'file' => ['file', 'max:1024', 'nullable'],
            'image' => ['image', 'max:1024', 'nullable'],
            'markdown_text' => ['nullable', 'string'],
            'w_y_s_i_w_y_g' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ];
    }
}
