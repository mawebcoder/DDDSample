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

    public function test_can_update_a_role()
    {
        $role = Role::factory()
            ->has(Permission::factory(), 'permissions')
            ->create();

        $permissions = Permission::factory()->count(3)->create();

        $data = [
            'persian_title' => $this->faker->unique()->name,
            'english_title' => $this->faker->unique()->name,
            'is_active' => $this->faker->boolean,
            'permissions' => $permissions->pluck('id')->toArray()
        ];

        $response = $this->putJson(route('role.update', ['id' => $role->id]), $data);

        $response->assertOk();

        $this->assertDatabaseHas((new Role())->getTable(), Arr::except($data, ['permissions']));

        foreach ($permissions as $permission) {
            $this->assertDatabaseHas('permission_role', [
                'role_id' => $role->id,
                'permission_id' => $permission->id
            ]);
        }
    }

    public function test_can_delete_a_role()
    {
        $role = Role::factory()->create();

        $response = $this->deleteJson(route('role.delete', ['id' => $role->id]));

        $response->assertOk();

        $this->assertModelMissing($role);
    }


    public function test_role_list_select_box()
    {

    }

    public function test_roles_list_table()
    {
    }

    public function test_update_role_validation()
    {
    }

    public function test_register_role_validation()
    {
    }

    public function test_can_not_update_role_if_another_role_exists_with_same_persian_or_english_title()
    {
    }

    public function test_can_not_update_role_if_role_not_exists()
    {
    }

    public function test_can_not_register_role_if_another_role_with_same_persian_or_english_title_exist()
    {
    }
}
