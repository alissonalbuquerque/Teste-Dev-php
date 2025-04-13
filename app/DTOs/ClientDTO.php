<?php

namespace App\DTOs;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ClientDTO
{
    public ?string $name;
    public ?string $email;
    public ?string $cpf;
    public ?string $phone;
    public ?string $cep;
    public ?string $address;

    public function __construct(array $data)
    {
        $this->name    = Arr::has($data, 'name')    ? $data['name']                 : null;
        $this->email   = Arr::has($data, 'email')   ? $data['email']                : null;
        $this->cpf     = Arr::has($data, 'cpf')     ? self::unmask($data['cpf'])    : null;
        $this->phone   = Arr::has($data, 'phone')   ? self::unmask($data['phone'])  : null;
        $this->cep     = Arr::has($data, 'cep')     ? self::unmask($data['cep'])    : null;
        $this->address = Arr::has($data, 'address') ? $data['address']              : null;
    }

    public function toArray(): array
    {
        $data = [
            'name'  => $this->name,
            'email' => $this->email,
            'cpf'   => $this->cpf,
            'phone' => $this->phone,
            'cep'   => $this->cep,
            'address' => $this->address
        ];

        $collection = collect($data)->filter(fn($value) => isset($value));

        return $collection->toArray();
    }

    public static function unmask(string $value): string
    {
        return preg_replace('/\D/', '', $value);
    }
}
