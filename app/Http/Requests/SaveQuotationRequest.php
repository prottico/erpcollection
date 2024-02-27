<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SaveQuotationRequest extends FormRequest
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
        // return [
        //     'credit_start_date' => 'required|date',
        //     'debt_capital' => 'required|numeric',
        //     'term' => 'required|numeric',
        //     'current_interest_rate' => 'required|numeric',
        //     'default_interest_rate' => 'required|numeric',
        //     'interest_owed' => 'required|numeric',
        //     'last_payment_day' => 'required|date',
        //     'currency' => 'required|string',
        //     // 'base_execution_document' => 'required|file',
        //     'base_execution_document.*' => 'required|file|mimes:pdf,doc,docx|max:10240', // Máximo 10MB por archivo y permite PDF, DOC y DOCX
        //     'description' => 'required|string',
        //     'inlineRadioOptions' => [
        //         'required',
        //         Rule::requiredIf(function () {
        //             return empty($this->input('inlineRadioOptions'));
        //         })
        //     ],
        //     'comments' => 'required|string',
        // ];

        return [
            'credit_start_date' => 'required|date',
            'debt_capital' => 'required|numeric',
            'term' => 'required',
            'current_interest_rate' => 'required|numeric',
            'default_interest_rate' => 'required|numeric',
            'interest_owed' => 'required|numeric',
            'last_payment_day' => 'required|date',
            'currency' => 'required|string',
            'base_execution_document' => 'required',
            'description' => 'required|string',
            'type_payment_id' => [
                'required',
                Rule::requiredIf(function () {
                    return empty($this->input('type_payment_id'));
                })
            ],
            'comments' => 'nullable|string',
        ];
    }
}
