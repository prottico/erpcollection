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
        return [
            'credit_start_date' => 'required|date',
            'debt_capital' => 'required|numeric',
            'term' => 'required',
            'current_interest_rate' => 'required|numeric',
            'default_interest_rate' => 'required|numeric',
            'interest_owed' => 'required|numeric',
            'currency_id' => 'required',
            'base_execution_document' => 'required|file|mimes:pdf,doc,docx|max:10240',
            'description' => 'required|string',
            'type_payment_id' => [
                'required',
                Rule::requiredIf(function () {
                    return empty($this->input('type_payment_id'));
                }),
            ],
            'comments' => 'nullable|string',
            'credit_due_date' => 'required',
            'amount_last_payment' => 'required',
            'last_payment_day' => 'nullable',
            'no_apply_last_payment_day' => 'nullable'
        ];
    }
}
