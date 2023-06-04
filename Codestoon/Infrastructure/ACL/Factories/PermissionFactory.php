<?php

namespace Codestoon\Infrastructure\ACL\Factories;

use Codestoon\Domains\ACL\Entities\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{

    protected $model=Permission::class;
    public function definition(): array
    {
        return [
            Permission::COLUMN_ENGLISH_TITLE => $this->faker->unique()->name,
            Permission::COLUMN_PERSIAN_TITLE => $this->faker->unique()->name,
            Permission::COLUMN_IS_ACTIVE => $this->faker->boolean,
        ];
    }
}
