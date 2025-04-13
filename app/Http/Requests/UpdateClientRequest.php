<?php

namespace App\Http\Requests;

use App\DTOs\ClientDTO;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
        $client = $this->route('client');

        return [
            'name'    => ['string', 'max:255'],
            'email'   => ['email', "unique:clients,email,{$client}"],
            'cpf'     => ['cpf', "unique:clients,cpf,{$client}"],
            'phone'   => ['celular_com_ddd'],
            'cep'     => ['required', 'formato_cep'],
            // 'address' => [],
        ];
    }

    public function prepareForValidation()
    {
        /** @var boolean */
        $has_cpf = Str::of($this->cpf)->isNotEmpty();

        if($has_cpf) {
            $this->merge([
                'cpf' => ClientDTO::unmask($this->cpf ?? '')
            ]);
        }
    }
}
