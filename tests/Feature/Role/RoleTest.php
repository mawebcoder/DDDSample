<?php

namespace Tests\Feature\Role;

use Codestoon\Domains\ACL\Entities\Permission;
use Codestoon\Domains\ACL\Entities\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Arr;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;

class RoleTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();
    }

    public function test_can_register_an_user()
    {
        $permissions = Permission::factory()->count(3)->create();

        $data = [
            'persian_title' => $this->faker->unique()->name,
            'english_title' => $this->faker->unique()->name,
            'is_active' => $this->faker->boolean,
            'permissions' => $permissions->pluck('id')->toArray()
        ];

        $response = $this->postJson(route('role.store'), $data);

        $response->assertCreated();

        $this->assertDatabaseHas((new Role()), Arr::except($data, ['permissions']));


        $role = Role::query()->firstWhere(Role::COLUMN_PERSIAN_TITLE, $data[Role::COLUMN_PERSIAN_TITLE]);

        foreach ($permissions as $permission) {
            $this->assertDatabaseHas('permission_role', [
                'role_id' => $role->id,
                'permission_id' => $permission->id
            ]);
        }
    }

    public function test_can_update_an_user()
    {
    }

    public function test_can_delete_an_user()
    {
    }

    public function test_can_force_delete_an_user()
    {
    }

    public function test_can_restore_an_user()
    {
    }

    public function test_users_list()
    {
    }

    public function test_update_user_validation()
    {
    }

    public function test_register_user_validation()
    {
    }
}
