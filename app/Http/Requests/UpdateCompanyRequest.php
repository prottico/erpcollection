<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'comercial_name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'responsible_name' => 'required',
            'responsible_lastname' => 'required',
            'responsible_email' => ['required', 'email'],
            'responsible_password' => ['nullable'],
        ];
    }
}
