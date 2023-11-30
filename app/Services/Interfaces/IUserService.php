<?php

namespace App\Services\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserService
{
    public function getAll() : LengthAwarePaginator;
    public function getById(int $id) : User;
    public function create(array $data) : User;
    public function update(array $data, int $id) : User;
    public function delete(int $id): bool;
}
