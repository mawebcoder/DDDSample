<?php

namespace App\Providers;

use Codestoon\Domains\ACL\Repositories\ACLReadRepositoryInterface;
use Codestoon\Domains\ACL\Repositories\ACLWriteRepositoryInterface;
use Codestoon\Domains\ACL\Services\RegisterRoleServiceInterface;
use Codestoon\Infrastructure\ACL\Repositories\ACLReadRepository;
use Codestoon\Infrastructure\ACL\Repositories\ACLWriteRepository;
use Codestoon\Infrastructure\ACL\Services\RegisterRoleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerACLDomain();
        $this->registerUserDomain();
    }


    private function registerACLDomain(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Codestoon/Infrastructure/ACL/Migrations');

        $this->app->bind(ACLWriteRepositoryInterface::class, ACLWriteRepository::class);

        $this->app->bind(ACLReadRepositoryInterface::class, ACLReadRepository::class);
        $this->app->bind(RegisterRoleServiceInterface::class, RegisterRoleService::class);
    }

    private function registerUserDomain(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Codestoon/Infrastructure/User/Migrations');
    }
}
