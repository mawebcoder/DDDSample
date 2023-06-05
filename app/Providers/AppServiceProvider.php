<?php

namespace App\Providers;

use App\TestOne;
use App\TestOneInterface;
use App\TestTwo;
use App\TestTwoInterface;
use Codestoon\Domains\ACL\Repositories\ACLReadRepositoryInterface;
use Codestoon\Domains\ACL\Repositories\ACLWriteRepositoryInterface;
use Codestoon\Domains\ACL\Services\DeleteRoleServiceInterface;
use Codestoon\Domains\ACL\Services\RegisterRoleServiceInterface;
use Codestoon\Domains\ACL\Services\UpdateRoleServiceInterface;
use Codestoon\Domains\User\Repositories\UserReadRepositoryInterface;
use Codestoon\Domains\User\Repositories\UserWriteRepositoryInterface;
use Codestoon\Infrastructure\ACL\Repositories\ACLReadRepository;
use Codestoon\Infrastructure\ACL\Repositories\ACLWriteRepository;
use Codestoon\Infrastructure\ACL\Services\DeleteRoleService;
use Codestoon\Infrastructure\ACL\Services\RegisterRoleService;
use Codestoon\Infrastructure\ACL\Services\UpdateRoleService;
use Codestoon\Infrastructure\User\Repositories\UserReadRepository;
use Codestoon\Infrastructure\User\Repositories\UserWriteRepository;
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
        $this->registerFileDomain();
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
        $this->app->bind(ACLWriteRepositoryInterface::class, function () {
            return resolve(ACLWriteRepository::class);
        });

        $this->app->bind(ACLReadRepositoryInterface::class, function () {
            return resolve(ACLReadRepository::class);
        });

        /**
         * Load Translations
         */
        $this->loadTranslationsFrom(__DIR__ . '/../../Codestoon/Domains/ACL/Lang', 'acl');

        /**
         * Load Elasticsearch migrations
         */
        Elasticsearch::loadMigrationsFrom(__DIR__ . '/../../Codestoon/Infrastructure/ACL/Elasticsearch/Migrations');
    }

    private function registerUserDomain(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../Codestoon/Infrastructure/User/Migrations');

        /**
         * Load Translations
         */

        $this->loadTranslationsFrom(__DIR__ . '/../../Codestoon/Domains/User/Lang', 'user');


        /**
         * bind Repositories
         */

        $this->app->bind(UserReadRepositoryInterface::class, function () {
            return resolve(UserReadRepository::class);
        });

        $this->app->bind(UserWriteRepositoryInterface::class, function () {
            return resolve(UserWriteRepository::class);
        });
    }

    private function registerFileDomain(): void
    {
        /**
         * Load migrations
         */

        $this->loadMigrationsFrom(__DIR__ . '/../../Codestoon/Infrastructure/File/Migrations');
    }
}
