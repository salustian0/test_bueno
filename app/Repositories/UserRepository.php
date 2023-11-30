<?php

namespace App\Repositories;


namespace App\Repositories;

use App\Consts\AppConsts;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements IUserRepository
{

    public function getAll(): LengthAwarePaginator
    {
        return User::with('roles')->paginate(AppConsts::PAGINATION_PER_PAGE);
    }

    public function getById(int $id): User
    {
        return User::with('roles')->findOrFail($id);
    }

    public function create(array $data): User
    {
       return User::create($data);
    }

    public function update(User $user): User
    {
        $user->update();
        return $user;
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
