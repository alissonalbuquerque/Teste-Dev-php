<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository implements ClientRepositoryInterface
{   
    private Client $model;

    public function __construct(Client $model) {
        $this->model = $model;
    }

    public function all(?int $per_page) : LengthAwarePaginator {
        return $this->model->paginate($per_page);
    }

    public function create(array $data) : Client {
        return $this->model->create($data);
    }

    public function update(string|int $id, array $data) : ?Client {
        $instance = $this->model->findOrFail($id);
        $instance->update($data);
        $instance->refresh();
        return $instance;
    }

    public function delete(string|int $id) : bool|null {
        $instance = $this->model->findOrFail($id);
        return $instance->delete();
    }

    public function findById(string|int $id) : ?Client {
        return $this->model->findOrFail($id);
    }

    public function findByNameAndCfpAndCep(?string $name, ?string $cpf, ?string $cep, ?int $per_page = 0) : LengthAwarePaginator {
        
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

        return $query->paginate($per_page);
    }
}