<?php

namespace Codestoon\Infrastructure\User\Factories;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\User\Entities\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model=User::class;
    public function definition(): array
    {
        return [
            User::COLUMN_EMAIL => $this->faker->unique()->email,
            User::COLUMN_PASSWORD => $this->faker->password,
            User::COLUMN_PHONE_NUMBER => $this->faker->unique()->phoneNumber,
            User::COLUMN_FIRST_NAME => $this->faker->firstName,
            User::COLUMN_LAST_NAME => $this->faker->lastName,
            User::COLUMN_ROLE_ID => Role::factory(),
            User::COLUMN_IS_ACTIVE => $this->faker->boolean
        ];
    }
}
