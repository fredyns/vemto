<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubrecordUpdateRequest extends FormRequest
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
            'record_id' => ['required', 'uuid', 'exists:records,id'],
            'datetime' => ['nullable', 'date'],
            'date' => ['nullable', 'date'],
            'time' => ['nullable', 'date_format:H:i:s'],
            'n_p_w_p' => ['nullable'],
            'markdown_text' => ['nullable', 'string'],
            'w_y_s_i_w_y_g' => ['nullable', 'string'],
            'file' => ['file', 'max:1024', 'nullable'],
            'image' => ['image', 'max:1024', 'nullable'],
            'i_p_address' => ['nullable'],
            'j_s_o_n_list.*' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
        ];
    }
}
