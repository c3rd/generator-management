<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['alpha:ascii', 'max:50', 'required'],
            'last_name' => ['alpha:ascii', 'max:255', 'required'],
            'birth_date' => ['date_format:Y-m-d', 'required'],
            'start_date' => ['date_format:Y-m-d'],
            'end_date' => ['date_format:Y-m-d'],
            'birth_date' => ['date_format:Y-m-d', 'required'],
            'monthly_rate' => ['decimal:2', 'required'],
            'cpf' => ['string', 'min:14', 'max:14']
        ];
    }
}
