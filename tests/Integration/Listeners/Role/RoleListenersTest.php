<?php

namespace Tests\Integration\Listeners\Role;

use Codestoon\Domains\ACL\Entities\Permission;
use Codestoon\Domains\ACL\Entities\Role;
use Codestoon\Domains\ACL\Events\RoleCreatedEvent;
use Codestoon\Domains\ACL\Events\RoleDeletedEvent;
use Codestoon\Domains\User\Entities\User;
use Codestoon\Infrastructure\ACL\Elasticsearch\Models\ERole;
use Codestoon\Infrastructure\ACL\Listeners\DeleteRoleFromElasticsearchListener;
use Codestoon\Infrastructure\ACL\Listeners\SyncRoleWithElasticsearchListener;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\RequestException;
use Mawebcoder\Elasticsearch\Exceptions\FieldNotDefinedInIndexException;
use ReflectionException;
use Tests\TestCase;
use Throwable;

class RoleListenersTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    /**
     * @throws Throwable
     * @throws ReflectionException
     * @throws RequestException
     * @throws GuzzleException
     */
    public function test_delete_role_from_elasticsearch_listener()
    {
        $role = Role::factory()->create();

        $mock = $this->getMockBuilder(RoleDeletedEvent::class)
            ->setConstructorArgs(['role' => $role])
            ->getMock();

        $listener = new DeleteRoleFromElasticsearchListener();

        $listener->handle($mock);
    }

    /**
     * @throws FieldNotDefinedInIndexException
     * @throws ReflectionException
     * @throws RequestException
     * @throws GuzzleException
     * @throws Throwable
     */
    public function test_syc_role_with_elasticsearch_listener()
    {
        $role = Role::factory()
            ->has(Permission::factory()->count(4), 'permissions')
            ->has(User::factory()->count(3), 'users')
            ->create();

        $mock = $this->getMockBuilder(RoleCreatedEvent::class)
            ->setConstructorArgs([
                'role' => $role
            ])->getMock();

        $listener = new SyncRoleWithElasticsearchListener();

        $listener->handle($mock);

        sleep(2);

        $eRole = ERole::newQuery()
            ->find($role->id);

        $this->assertNotNull($eRole);

        $eRole->delete();
    }
}
