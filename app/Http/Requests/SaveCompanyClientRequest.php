<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCompanyClientRequest extends FormRequest
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
            'physical_client' => ['required'],
            'identification' => ['required'],
            'name' => ['required'],
            'comercial_name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
        ];
    }
}
