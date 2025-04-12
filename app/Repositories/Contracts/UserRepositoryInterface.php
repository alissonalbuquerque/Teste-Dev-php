<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function all() : Collection;
    public function create(array $data) : User;
    public function update(string|int $id, array $data) : ?User;
    public function delete(string|int $id) : bool;
    public function findById(string|int $id) : ?User;
    public function findByNameAndCfpAndCep(?string $name, ?string $cpf, ?string $cep) : Collection;
}