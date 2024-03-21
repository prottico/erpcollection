<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLawyerQuotationRequest extends FormRequest
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
            'iva' => ['required'],
            'type_case_id' => ['required'],
            'comment' => ['required'],
            'subtotal' => ['required'],
            'total' => ['required'],

            "honorary1" => ['nullable'],
            "description_honorary_1" => ['nullable'],
            "price_honorary_1" => ['nullable'],
            "honorary2" => ['nullable'],
            "description_honorary_2" => ['nullable'],
            "price_honorary_2" => ['nullable'],
            "honorary3" => ['nullable'],
            "description_honorary_3" => ['nullable'],
            "price_honorary_3" => ['nullable'],
        ];
    }
}
