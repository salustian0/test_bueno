<?php

namespace App\Repositories;

use App\Consts\AppConsts;
use App\Repositories\Interfaces\IRoleRepository;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleRepository implements IRoleRepository
{

    public function getPaginated(): LengthAwarePaginator
    {
        return Role::paginate(AppConsts::PAGINATION_PER_PAGE);
    }

    public function getAll(): Collection
    {
        return Role::all();
    }


    public function getById(int $id): Role
    {
        return Role::findOrFail($id);
    }

    public function create(array $data): Role
    {
       return Role::create($data);
    }

    public function update(Role $role): Role
    {
        $role->update();
        return $role;
    }

    public function delete(Role $role): bool
    {
        return $role->delete();
    }
}
