<?php

namespace App\Repositories\Contracts;

use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface
{
    public function all(?int $per_page) : LengthAwarePaginator;
    public function create(array $data) : Client;
    public function update(string|int $id, array $data) : ?Client;
    public function delete(string|int $id) : bool|null;
    public function findById(string|int $id) : ?Client;
    public function findByNameAndCfpAndCep(?string $name, ?string $cpf, ?string $cep, ?int $per_page) : LengthAwarePaginator;
}