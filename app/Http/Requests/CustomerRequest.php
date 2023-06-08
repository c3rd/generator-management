<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $minIdentification = $this->identification_type === 'cpf' ? 14 : 12;

        $rules = [
            'first_name' => ['alpha:ascii', 'max:50', 'required'],
            'last_name' => ['alpha:ascii', 'max:255', 'required'],
            'identification_number' => ['min:' . $minIdentification, 'required'],
            'identification_type' => ['required'],
            'email' => ['email:rfc,dns'],
            'birth_date' => ['date_format:Y-m-d', 'required'],
            'monthly_rate' => ['decimal:2', 'required'],
            'cpf' => ['string', 'min:14', 'max:14']
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            '*.max' => "O campo :attribute permite no máximo :max caracteres",
            '*.required' => "O campo :attribute é obrigatório",
            '*.alpha' => "Digite um nome válido",
            'identification_number.min' => "O campo " . strtoupper($this->identification_type) . " deve ter ao menos :min caracteres",
            'email.*' => "Insira um email válido",
        ];
    }
}
