<?php

namespace App\Providers;

use Codestoon\Domains\ACL\Repositories\ACLReadRepositoryInterface;
use Codestoon\Domains\ACL\Repositories\ACLWriteRepositoryInterface;
use Codestoon\Domains\ACL\Services\RegisterRoleServiceInterface;
use Codestoon\Domains\ACL\Services\UpdateRoleServiceInterface;
use Codestoon\Infrastructure\ACL\Repositories\ACLReadRepository;
use Codestoon\Infrastructure\ACL\Repositories\ACLWriteRepository;
use Codestoon\Infrastructure\ACL\Services\RegisterRoleService;
use Codestoon\Infrastructure\ACL\Services\UpdateRoleService;
use Illuminate\Support\ServiceProvider;
use Mawebcoder\Elasticsearch\Facade\Elasticsearch;

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
        /**
         * Load migrations
         */
        $this->loadMigrationsFrom(__DIR__ . '/../../Codestoon/Infrastructure/ACL/Migrations');

        /**
         * Bind Repositories
         */
        $this->app->bind(ACLWriteRepositoryInterface::class, ACLWriteRepository::class);
        $this->app->bind(ACLReadRepositoryInterface::class, ACLReadRepository::class);

        /**
         * Load Translations
         */
        $this->loadTranslationsFrom(__DIR__ . '/../../Codestoon/Domains/ACL/Lang', 'acl');

        /**
         * Load Elasticsearch migrations
         */
        Elasticsearch::loadMigrationsFrom(__DIR__ . '/../../Codestoon/Infrastructure/ACL/Elasticsearch/Migrations');

        /**
         * Bind Services
         */
        $this->app->bind(RegisterRoleServiceInterface::class, RegisterRoleService::class);
        $this->app->bind(UpdateRoleServiceInterface::class, UpdateRoleService::class);
    }

    private function registerUserDomain(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Codestoon/Infrastructure/User/Migrations');
    }
}
