<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class SearchCepService
{
    protected string $baseUrl;

    private int $status;

    public function __construct() {
        $this->baseUrl = 'https://brasilapi.com.br/api/cep/v2';
    }

    /**
     * @return array
     * @throw Exception
     */
    public function search(string $cep) : array|Exception
    {
        $response = Http::get("{$this->baseUrl}/{$cep}");

        if ($response->successful()) {
            return $response->json();
        }

        $this->status = $response->status();

        throw new Exception("{$this->status}");
    }
}
