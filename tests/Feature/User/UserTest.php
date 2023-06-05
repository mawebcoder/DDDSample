<?php

namespace Tests\Feature\User;

use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\User\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function test_can_register_user()
    {
        $data = [
            User::COLUMN_FIRST_NAME => $this->faker->firstName,
            User::COLUMN_LAST_NAME => $this->faker->lastName,
            User::COLUMN_PHONE_NUMBER => '09226526781',
            User::COLUMN_EMAIL => $this->faker->unique()->email,
            User::COLUMN_ROLE_ID => Role::factory()->create()->id,
            User::COLUMN_IS_ACTIVE => intval($this->faker->boolean),
            User::COLUMN_PASSWORD => 'Mohammad$1234',
            'confirm_password' => 'Mohammad$1234'
        ];

        $response = $this->postJson(route('user.store'), $data);

        $response->assertCreated();

        $this->assertDatabaseHas(
            (new User())->getTable(),
            Arr::except($data, [User::COLUMN_PASSWORD, 'confirm_password'])
        );
    }

    public function test_can_update_user()
    {
        $user = User::factory()
            ->for(Role::factory(), 'role')
            ->create();

        $data = [
            User::COLUMN_FIRST_NAME => $this->faker->firstName,
            User::COLUMN_LAST_NAME => $this->faker->lastName,
            User::COLUMN_PHONE_NUMBER => '09226526781',
            User::COLUMN_EMAIL => $this->faker->unique()->email,
            User::COLUMN_ROLE_ID => Role::factory()->create()->id,
            User::COLUMN_IS_ACTIVE => intval($this->faker->boolean),
            User::COLUMN_PASSWORD => 'Mohammad$1234',
            'confirm_password' => 'Mohammad$1234'
        ];

        $response = $this->putJson(route('user.update', ['id' => $user->id]), $data);

        $response->assertOk();

        $this->assertDatabaseHas(
            (new User())->getTable(),
            Arr::except($data, [User::COLUMN_PASSWORD, 'confirm_password'])
        );
    }

    public function test_can_delete_user()
    {
        $user = User::factory()->create();

        $response=$this->deleteJson(route('user.delete',['id'=>$user->id]));

        $response->assertOk();

        $this->assertModelMissing($user);

    }

    public function test_update_user_validation()
    {
    }

    public function test_register_user_validation()
    {
    }

    public function test_users_list()
    {
    }

    public function test_can_not_update_user_if_user_not_exists()
    {

    }

    public function test_can_not_update_user_if_another_user_with_same_email_or_phone_number_exists(){

    }

    public function test_can_not_register_user_if_another_user_exists_with_same_email_or_phone_number()
    {

    }

    public function test_can_not_register_user_if_role_not_exists()
    {

    }
}
