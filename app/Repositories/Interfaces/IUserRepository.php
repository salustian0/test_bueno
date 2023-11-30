<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface IUserRepository
{
    public function getAll() : LengthAwarePaginator;
    public function getById(int $id) : User;

    public function create(array $data) : User;
    public function update(User $user) : User;
    public function delete(User $user): bool;
}
