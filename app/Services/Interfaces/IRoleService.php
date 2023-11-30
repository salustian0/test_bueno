<?php

namespace App\Services\Interfaces;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface IRoleService
{
    public function getAll() : Collection;
    public function getPaginated() : LengthAwarePaginator;
    public function getById(int $id) : Role;
    public function create(array $data) : Role;
    public function update(array $data, int $id) : Role;
    public function delete(int $id): bool;
}
