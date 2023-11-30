<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IRoleRepository
{
    public function getAll() : Collection;
    public function getPaginated() : LengthAwarePaginator;
    public function getById(int $id) : Role;

    public function create(array $data) : Role;
    public function update(Role $role) : Role;
    public function delete(Role $role): bool;
}
