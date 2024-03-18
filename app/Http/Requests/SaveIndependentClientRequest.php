<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveIndependentClientRequest extends FormRequest
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
            'identity_type_id' => ['required'],
            'identification' => ['required'],
            'name' => ['required'],
            'lastname' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['nullable'],
            'associated_company' => ['nullable'],
        ];
    }
}
