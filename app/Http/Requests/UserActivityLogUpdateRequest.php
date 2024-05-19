<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserActivityLogUpdateRequest extends FormRequest
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
            'at' => ['required', 'date'],
            'user_id' => ['required', 'uuid', 'exists:users,id'],
            'title' => ['required', 'max:255', 'string'],
            'link' => ['nullable', 'string', 'url'],
            'message' => ['nullable', 'string'],
            'i_p_address' => ['nullable', 'max:255'],
        ];
    }
}
