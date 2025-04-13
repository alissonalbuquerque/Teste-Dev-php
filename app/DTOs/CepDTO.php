<?php

namespace App\DTOs;

class CepDTO
{
    public string $street;
    public string $neighborhood;
    public string $city;
    public string $state;
    
    public string $address;

    public function __construct(array $data)
    {
        $this->street       = $this->checkValue($data['street']);
        $this->neighborhood = $this->checkValue($data['neighborhood']);
        $this->city         = $this->checkValue($data['city']);
        $this->state        = $this->checkValue($data['state']);

        $this->mountAddress();
    }

    public function toArray(): array
    {
        return [
            'street'       => $this->street,
            'neighborhood' => $this->neighborhood,
            'city'         => $this->city,
            'state'        => $this->state,
        ];
    }

    public function checkValue($value = null) : string 
    {
        return $value ?? '??';
    }

    private function mountAddress() : void {
        $this->address = "{$this->street}, {$this->neighborhood}, {$this->city}, {$this->state}";
    }
}
