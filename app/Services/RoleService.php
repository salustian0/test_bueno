<?php

namespace App\Services;

use App\Repositories\Interfaces\IRoleRepository;
use App\Services\Interfaces\IRoleService;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleService implements  IRoleService
{

    public function __construct(private readonly IRoleRepository $roleRepository)
    {}

    public function getPaginated(): LengthAwarePaginator
    {
        return $this->roleRepository->getPaginated();
    }

    public function getAll(): Collection
    {
        return $this->roleRepository->getAll();
    }

    public function getById(int $id): Role
    {
        return $this->roleRepository->getById($id);
    }

    public function create(array $data): Role
    {
        return $this->roleRepository->create($data);
    }

    public function update(array $data, int $id): Role
    {
        $role = $this->roleRepository->getById($id);

        if(!$role){
            throw new HttpResponseException('erro');
        }

        $role->fill($data);

        return $this->roleRepository->update($role);
    }

    public function delete(int $id): bool
    {
        $role = $this->roleRepository->getById($id);

        if(!$role){
            throw new \Exception('not exists');
        }

        return $this->roleRepository->delete($role);
    }
}
