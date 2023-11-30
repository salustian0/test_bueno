<?php

namespace App\Providers;


use App\Repositories\Interfaces\IRoleRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\Interfaces\IRoleService;
use App\Services\Interfaces\IUserService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IRoleService::class, RoleService::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);

        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserRepository::class, UserRepository::class );    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
