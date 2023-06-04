<?php

namespace Codestoon\Infrastructure\ACL\Factories;

use Codestoon\Domains\ACL\Entities\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{

    protected $model=Role::class;
    public function definition(): array
    {
        return [
            Role::COLUMN_IS_ACTIVE => $this->faker->boolean,
            Role::COLUMN_PERSIAN_TITLE => $this->faker->unique()->name,
            Role::COLUMN_ENGLISH_TITLE => $this->faker->unique()->name
        ];
    }
}
