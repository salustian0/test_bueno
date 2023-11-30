<?php

namespace App\Services;

use App\Mail\Sender;
use App\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use App\Services\Interfaces\IUserService;
use App\Validation\UserValidator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserService implements IUserService
{

    public function __construct(
        private readonly IUserRepository $userRepository,
        private readonly  UserValidator $userValidator,
        private Request $request,
        private FcmService $fcmService
    )
    {}

    public function getAll(): LengthAwarePaginator
    {
        return  $this->userRepository->getAll();
    }

    public function getById(int $id): User
    {
       return $this->userRepository->getById($id);
    }

    public function create(array $data): User
    {
        $validator = $this->userValidator->validate($data);

        if($validator->fails()){
            throw new ValidationException($validator);
        }

        $roles = $data['roles'];
        unset($data['roles']);

        $user =  $this->userRepository->create($data);
        $user->roles()->sync($roles);
        $user->load('roles');

        return $user;
    }

    public function update(array $data, int $id): User
    {
        $validator = $this->userValidator->validate($data, $id);

        if($validator->fails()){
            throw new ValidationException($validator);
        }

        $user = $this->userRepository->getById($id);

        if(!$user){
            throw new \Exception('not exists');
        }

        $roles = $data['roles'];
        unset($data['roles']);

        $user->fill($data);
        $user->roles()->sync($roles);

        /**
         * Não enviar email ou notificacao para alterações dos proprios dados
         */
        if($this->request->user()->id != $user->id){
            $this->fcmService->send($user);
            Mail::to($user)->send(new Sender(['target_name' => $user->name, 'changed_by' => $this->request->user()->name]));
        }

        return $this->userRepository->update($user);
    }

    public function delete(int $id): bool
    {
        $user = $this->userRepository->getById($id);

        if(!$user){
            throw new \Exception('not exists');
        }

        $user->roles()->detach();
        $user->device_tokens()->detach();

        return $this->userRepository->delete($user);
    }

}
