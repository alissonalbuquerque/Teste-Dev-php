<?php

namespace App\Http\Requests;

use App\DTOs\ClientDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the client is authorized to make this request.
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
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'unique:clients,email'],
            'cpf'     => ['required', 'cpf', 'unique:clients,cpf'],
            'phone'   => ['required', 'celular_com_ddd'],
            'cep'     => ['required', 'formato_cep'],
            // 'address' => [],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'cpf' => ClientDTO::unmask($this->cpf ?? '')
        ]);
    }
}
