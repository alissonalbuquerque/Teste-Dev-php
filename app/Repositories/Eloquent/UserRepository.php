<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{   
    private User $model;

    public function __construct(User $model) {
        $this->model = $model;
    }

    public function all() : Collection {
        return $this->model->all();
    }

    public function create(array $data) : User {
        return $this->model->create($data);
    }

    public function update(string|int $id, array $data) : ?User {
        $instance = $this->model->findOrFail($id);
        $instance->update($data);
        return $instance;
    }

    public function delete(string|int $id) : bool {
        return $this->model->delete($id);
    }

    public function findById(string|int $id) : ?User {
        return $this->model->findOrFail($id);
    }

    public function findByNameAndCfpAndCep(?string $name, ?string $cpf, ?string $cep) : Collection {
        
        $query = $this->model->query();

        if($name) {
            $query->where('name', 'like', "%{$name}%");
        }

        if($cpf) {
            $query->where('cpf', 'like', "%{$cpf}%");
        }

        if($cep) {
            $query->where('cep', 'like', "%{$cep}%");
        }

        return $query->get();
    }
}